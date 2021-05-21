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
                    $index_data  = TutupBuka::where('tutup_buka.status', 'ON')->sortable()->paginate(20);
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
                    $return_data = ['companies' => $companies];
                    break;
                case ('divisi' || 'leader'):
                    $apps = Apps::all();
                    $return_data = ['apps' => $apps];
                    break;
                case 'anak':
                    $apps = Apps::all();
                    $open = Carbon::now()->toDateTimeString();
                    $return_data = ['apps' => $apps, 'open' => $open];
                    break;
                default:
                    $return_data = [];
                    break;
            }
            return view("pages.{$page}.{$page}_add", $return_data);
        }

        return abort(404);
    }

    public function edit(string $page, string $id)
    {
        if (view()->exists("pages.{$page}.{$page}_edit")) {
            switch ($page) {
                case 'company':
                    $data = Company::where('id_company', $id)->first();
                    $return_data = ['data' => $data, 'id' => $id];
                    break;
                case 'aplikasi':
                    $data = Apps::where('id_apps', $id)->first();
                    $companies = Company::all();
                    $return_data = ['companies' => $companies, 'id' => $id, 'data' => $data];
                    break;
                case 'divisi':
                    $data = Divisi::where('id_divisi', $id)->first();
                    $apps = Apps::all();
                    $return_data = ['apps' => $apps, 'id' => $id, 'data' => $data];
                    break;
                case 'leader':
                    $data = Leader::where('id_leader', $id)->first();
                    $apps = Apps::all();
                    $return_data = ['apps' => $apps, 'id' => $id, 'data' => $data];
                    break;
                case 'anak':
                    $data = Anak::where('id_anak', $id)->first();
                    $apps = Apps::all();
                    $return_data = ['apps' => $apps, 'id' => $id, 'data' => $data];
                    break;
                case 'tutupbuka':
                    $data = TutupBuka::where('id_tutupbuka', $id)->first();
                    $anak = Anak::where('id_anak', $data->id_anak)->first();
                    $return_data = ['anak' => $anak, 'data' => $data, 'id' => $id];
                    break;
                default:
                    $return_data = [];
                    break;
            }
            return view("pages.{$page}.{$page}_edit", $return_data);
        }

        return abort(404);
    }

    public function save(string $page, Request $request) {
        switch ($page) {
            case 'company':
                $validator = ApiHelper::saveCompany($request, new Company);
                break;
            case 'aplikasi':
                $validator = ApiHelper::saveAplikasi($request, new Apps);
                break;
            case 'divisi':
                $validator = ApiHelper::saveDivisi($request, new Divisi);
                break;
            case 'leader':
                $validator = ApiHelper::saveLeader($request, new Leader);
                break;
            case 'anak':
                $validator = ApiHelper::saveAnak($request, new Anak);
                break;
            case 'tutupbuka':
                ApiHelper::saveTutupBuka($request, new TutupBuka);
                break;
            default:
                $validator = [];
                break;
        }

        if (count($validator) > 0)
        {
            return redirect(route('page.add', $page))->withErrors($validator);
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
                $model_name = 'Company';
                break;
            case 'aplikasi':
                $model_name = 'Apps';
                break;
            case 'divisi':
                $model_name = 'Divisi';
                break;
            case 'leader':
                $model_name = 'Leader';
                break;
            case 'anak':
                $model_name = 'Anak';
                break;
            case 'tutupbuka':
                $model_name = 'TutupBuka';
                break;
            default:
                $model_name = 'Company';
                break;
        }

        $model = 'App\\'. $model_name;
        if (!empty($relation)) {
            $index_data = $model::where('status', 'ON')
                                ->whereHas($relation, function($query) use ($column, $filter) {
                                    $query->whereRaw('LOWER('.$column.') LIKE ?', [trim(strtolower($filter)).'%']);
                                })
                                ->sortable()->paginate(20);
        } else {
            $index_data = $model::where('status', 'ON')
                                ->whereRaw('LOWER('.$column.') LIKE ?', [trim(strtolower($filter)).'%'])
                                ->sortable()->paginate(20);
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
