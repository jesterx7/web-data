<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Helpers\PageHelper;
use App\Imports\TutupBukaImport;
use App\Imports\CompaniesImport;
use App\Imports\DivisiImport;
use App\Imports\LeaderImport;
use App\Imports\AppsImport;
use App\Imports\AnakImport;
use App\Exports\CustomExport;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function import(string $page, Request $request)
    {
        switch ($page) {
            case 'company':
                Excel::import(new CompaniesImport, request()->file('file'));
                break;
            case 'aplikasi':
                Excel::import(new AppsImport, request()->file('file'));
                break;
            case 'divisi':
                Excel::import(new DivisiImport, request()->file('file'));
                break;
            case 'leader':
                Excel::import(new LeaderImport, request()->file('file'));
                break;
            case 'anak':
                Excel::import(new AnakImport, request()->file('file'));
                break;
            case 'tutupbuka':
                Excel::import(new TutupBukaImport, request()->file('file'));
                break;
            default:
                break;
        }

        return back();
    }
    
    public function export(string $page, Request $request)
    {
        $model_name = PageHelper::model_name($page);
        $model      = 'App\\'. $model_name;
        $offset     = ($request->get('page') !== null) ? ($request->get('page') - 1) * 20 : 0;
        list($filters, $table_head) = PageHelper::build_data_table($page);
        if ($request->get('option') !== null) {
            $option     = explode(':', $request->get('option'));
            $relation   = $option[0];
            $column     = $option[1];
            $filter     = $request->get('search');

            if (!empty($relation)) {
                $data = $model::where('status', 'ON')
                                    ->whereHas($relation, function($query) use ($column, $filter) {
                                        $query->whereRaw('LOWER('.$column.') LIKE ?', [trim(strtolower($filter)).'%']);
                                    })->offset($offset)
                                    ->limit(20)
                                    ->get();
            } else {
                $data = $model::where('status', 'ON')
                                    ->whereRaw('LOWER('.$column.') LIKE ?', [trim(strtolower($filter)).'%'])
                                    ->offset($offset)
                                    ->limit(20)
                                    ->get();
            }
        } else {
            $data = $model::where('status', 'ON')
                                ->offset($offset)
                                ->limit(20)
                                ->get();
        }
        $exportData = [];
        $t_head = [];
        foreach ($table_head as $key => $value) {
            if ($key !== 'del_edit' && $key !== 'action') {
                $t_head[] = $value;
            }
        }
        $exportData[] = $t_head;

        switch ($page) {
            case 'company':
                foreach ($data as $value) {
                    $t_body = [
                        $value->id_company,
                        $value->nama_company
                    ];
                    $exportData[] = $t_body;
                }
                break;
            case 'aplikasi':
                foreach ($data as $value) {
                    $t_body = [
                        $value->id_apps,
                        $value->nama_apps,
                        $value->link_apps,
                        $value->companies->nama_company
                    ];
                    $exportData[] = $t_body;
                }
                break;
            case 'divisi':
                foreach ($data as $value) {
                    $t_body = [
                        $value->id_divisi,
                        $value->nama_divisi,
                        $value->apps->nama_apps
                    ];
                    $exportData[] = $t_body;
                }
                break;
            case 'leader':
                foreach ($data as $value) {
                    $t_body = [
                        $value->id_leader,
                        $value->username,
                        $value->password,
                        $value->apps->nama_apps
                    ];
                    $exportData[] = $t_body;
                }
                break;
            case 'anak':
                foreach ($data as $value) {
                    if ($value->tutupbuka->where('status', 'ON')->last()) {
                        if ($value->tutupbuka->where('status', 'ON')->last()->tanggal_buka != '9999-12-31 00:00:00') {
                            $status = 'OPEN';
                        } else {
                            $status = 'CLOSE';
                        }
                    } else {
                        $status = 'OPEN';
                    }
                    $t_body = [
                        $value->id_anak,
                        $value->username,
                        $value->password,
                        $value->divisi->nama_divisi,
                        $value->apps->nama_apps,
                        $status
                        
                    ];
                    $exportData[] = $t_body;
                }
                break;
            case 'tutupbuka':
                foreach ($data as $value) {
                    $t_body = [
                        $value->id_tutupbuka,
                        $value->anak->username,
                        $value->anak->apps->nama_apps,
                        $value->tanggal_tutup,
                        $value->tanggal_buka
                    ];
                    $exportData[] = $t_body;
                }
                break;
            default:
                break;
        }

        return Excel::download(new CustomExport($exportData), $model_name.'.xlsx');
    }
}
