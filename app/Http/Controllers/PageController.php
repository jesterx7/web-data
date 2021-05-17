<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Helpers\ApiHelper;
use App\Http\Controllers\Helpers\PageHelper;
use App\TutupBuka;
use App\Company;
use App\Leader;
use App\Divisi;
use App\Apps;
use App\Anak;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}.{$page}_list")) {
            switch ($page) {
                case 'company':
                    $index_data  = Company::where('companies.status', 'ON')->sortable()->paginate(20);
                    break;
                case 'aplikasi':
                    $index_data  = Apps::where('apps.status', 'ON')->sortable()->paginate(20);
                    break;
                case 'divisi':
                    $index_data  = Divisi::where('divisi.status', 'ON')->sortable()->paginate(20);
                    break;
                case 'leader':
                    $index_data  = Leader::where('leaders.status', 'ON')->sortable()->paginate(20);
                    break;
                case 'anak':
                    $index_data  = Anak::where('anak.status', 'ON')->sortable()->paginate(20);
                    break;
                case 'tutupbuka':
                    $index_data  = TutupBuka::sortable()->paginate(20);
                    break;
                case 'dashboard':
                    $now = Carbon::now();
                    $index_data  = [
                        'tutup_today'   => TutupBuka::whereDate('tanggal_tutup', Carbon::today())->count(),
                        'tutup_month'   => TutupBuka::whereMonth('tanggal_tutup', $now->month)->count(),
                        'buka_today'    => TutupBuka::whereDate('tanggal_buka', Carbon::today())->count(),
                        'buka_month'    => TutupBuka::whereMonth('tanggal_buka', $now->month)->count(),
                        'current_tutup' => TutupBuka::orderBy('tanggal_tutup', 'desc')->limit(10)->get(),
                        'current_buka'  => TutupBuka::orderBy('tanggal_buka', 'desc')->limit(10)->get(),
                    ];
                    break;
                default:
                    $page        = '';
                    $index_data  = [];
                    break;
            }
            list($filters, $table_head) = PageHelper::build_data_table($page);

            return view("pages.{$page}.{$page}_list", [
                'index_data'    => $index_data,
                'filters'       => $filters,
                'page'          => $page,
                'table_head'    => $table_head
            ]);
        }

        return abort(404);
    }

    public function add(string $page)
    {
        if (view()->exists("pages.{$page}.{$page}_add")) {
            switch ($page) {
                case 'aplikasi':
                    $companies = Company::all();
                    return view("pages.{$page}.{$page}_add", ['companies' => $companies]);
                case 'divisi':
                    $apps = Apps::all();
                    return view("pages.{$page}.{$page}_add", ['apps' => $apps]);
                case 'leader':
                    $apps = Apps::all();
                    return view("pages.{$page}.{$page}_add", ['apps' => $apps]);
                case 'anak':
                    $apps = Apps::all();
                    return view("pages.{$page}.{$page}_add", ['apps' => $apps]);
                default:
                    return view("pages.{$page}.{$page}_add");
            }
        }

        return abort(404);
    }

    public function edit(string $page, string $id)
    {
        if (view()->exists("pages.{$page}.{$page}_add")) {
            switch ($page) {
                case 'company':
                    $data = Company::where('id_company', $id)->first();
                    return view("pages.{$page}.{$page}_edit", ['data' => $data, 'id' => $id]);
                case 'aplikasi':
                    $companies = Company::all();
                    return view("pages.{$page}.{$page}_edit", ['companies' => $companies]);
                case 'divisi':
                    $apps = Apps::all();
                    return view("pages.{$page}.{$page}_edit", ['apps' => $apps]);
                case 'leader':
                    $apps = Apps::all();
                    return view("pages.{$page}.{$page}_edit", ['apps' => $apps]);
                case 'anak':
                    $data = Anak::where('id_anak', $id)->first();
                    $apps = Apps::all();
                    return view("pages.{$page}.{$page}_edit", ['apps' => $apps, 'data' => $data, 'id' => $id]);
                default:
                    return view("pages.{$page}.{$page}_edit");
            }
        }

        return abort(404);
    }

    public function save(string $page, Request $request) {
        switch ($page) {
            case 'company':
                ApiHelper::saveCompany($request, new Company);
                break;
            case 'aplikasi':
                ApiHelper::saveAplikasi($request, new Apps);
                break;
            case 'divisi':
                ApiHelper::saveDivisi($request, new Divisi);
                break;
            case 'leader':
                ApiHelper::saveLeader($request, new Leader);
                break;
            case 'anak':
                ApiHelper::saveAnak($request, new Anak);
                break;
            default:
                break;
        }

        return $this->index($page);
    }

    public function search(string $page, Request $request)
    {
        $option     = explode(':', $request->get('option'));
        $relation   = $option[0];
        $column     = $option[1];
        $filter     = $request->get('search');

        switch ($page) {
            case 'company':
                $index_data  = Company::where('companies.status', 'ON')
                                        ->where($column, 'LIKE', '%'. $filter. '%')
                                        ->sortable()->paginate(20);
                break;
            case 'aplikasi':
                if (!empty($relation)) {
                    $index_data  = Apps::whereHas($relation, function($query) use ($column, $filter) {
                                            $query->where($column, 'LIKE', '%'. $filter. '%');
                                        })
                                        ->where('status', 'ON')
                                        ->sortable()->paginate(20);
                    break;    
                }
                $index_data  = Apps::where('status', 'ON')
                                        ->where($column, 'LIKE', '%'. $filter. '%')
                                        ->sortable()->paginate(20);
                break;
            case 'divisi':
                if (!empty($relation)) {
                    $index_data  = Divisi::whereHas($relation, function($query) use ($column, $filter) {
                                            $query->where($column, 'LIKE', '%'. $filter. '%');
                                        })
                                        ->where('status', 'ON')
                                        ->sortable()->paginate(20);
                    break;    
                }
                $index_data  = Divisi::where('status', 'ON')
                                        ->where($column, 'LIKE', '%'. $filter. '%')
                                        ->sortable()->paginate(20);
                break;
            case 'leader':
                if (!empty($relation)) {
                    $index_data  = Leader::whereHas($relation, function($query) use ($column, $filter) {
                                            $query->where($column, 'LIKE', '%'. $filter. '%');
                                        })
                                        ->where('status', 'ON')
                                        ->sortable()->paginate(20);
                    break;    
                }
                $index_data  = Leader::where('status', 'ON')
                                        ->where($column, 'LIKE', '%'. $filter. '%')
                                        ->sortable()->paginate(20);
                break;
            case 'anak':
                if (!empty($relation)) {
                    $index_data  = Anak::whereHas($relation, function($query) use ($column, $filter) {
                                            $query->where($column, 'LIKE', '%'. $filter. '%');
                                        })
                                        ->where('status', 'ON')
                                        ->sortable()->paginate(20);
                    break;    
                }
                $index_data  = Anak::where('status', 'ON')
                                        ->where($column, 'LIKE', '%'. $filter. '%')
                                        ->sortable()->paginate(20);
                break;
            case 'tutupbuka':
                if (!empty($relation)) {
                    $index_data  = TutupBuka::whereHas($relation, function($query) use ($column, $filter) {
                                            $query->where($column, 'LIKE', '%'. $filter. '%');
                                        })
                                        ->where('status', 'ON')
                                        ->sortable()->paginate(20);
                    break;    
                }
                $index_data  = TutupBuka::where('status', 'ON')
                                        ->where($column, 'LIKE', '%'. $filter. '%')
                                        ->sortable()->paginate(20);
                break;
            default:
                $page        = '';
                $index_data  = [];
                break;
        }

        list($filters, $table_head) = PageHelper::build_data_table($page);

        return view("pages.{$page}.{$page}_list", [
            'index_data'    => $index_data,
            'filters'       => $filters,
            'page'          => $page,
            'table_head'    => $table_head
        ]);
    }
}
