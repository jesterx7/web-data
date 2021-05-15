<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Helpers\ApiHelper;
use App\Http\Controllers\Preparer\ContentPreparer;
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
                    $filters     = ['nama_company' => 'Company'];
                    $table_head  = [
                        'id_company'    => 'ID',
                        'nama_company'  => 'Company',
                        'del_edit'      => 'Edit / Delete'
                    ];
                    break;
                case 'aplikasi':
                    $index_data  = Apps::where('apps.status', 'ON')->sortable()->paginate(20);
                    $filters     = ['nama_apps' => 'Apps', 'link' => 'Link Apps', 'nama_company' => 'Company'];
                    $table_head  = [
                        'id_apps'                   => 'ID',
                        'nama_apps'                 => 'Apps',
                        'link_apps'                 => 'Link',
                        'companies.nama_company'    => 'Company',
                        'del_edit'                  => 'Edit / Delete'
                    ];
                    break;
                case 'divisi':
                    $index_data  = Divisi::where('divisi.status', 'ON')->sortable()->paginate(20);
                    $filters     = ['nama_divisi' => 'Division', 'nama_aplikasi' => 'Apps'];
                    $table_head  = [
                        'id_divisi'         => 'ID',
                        'nama_divisi'       => 'Division',
                        'apps.nama_apps'    => 'Apps',
                        'del_edit'          => 'Edit / Delete'
                    ];
                    break;
                case 'leader':
                    $index_data  = Leader::where('leaders.status', 'ON')->sortable()->paginate(20);
                    $filters     = ['username' => 'Username', 'nama_aplikasi' => 'Apps'];
                    $table_head  = [
                        'id_leader'         => 'ID',
                        'username'          => 'Username',
                        'password'          => 'Password',
                        'apps.nama_apps'    => 'Apps',
                        'del_edit'          => 'Edit / Delete'
                    ];
                    break;
                case 'anak':
                    $index_data  = Anak::where('anak.status', 'ON')->sortable()->paginate(20);
                    $filters     = ['username' => 'Username', 'nama_aplikasi' => 'Apps', 'divisi' => 'Division', 'leader' => 'Leader'];
                    $table_head  = [
                        'id_anak'               => 'ID',
                        'username'              => 'Username',
                        'password'              => 'Password',
                        'divisi.nama_divisi'    => 'Division',
                        'apps.nama_apps'        => 'Apps',
                        'action'                => 'Action',
                        'del_edit'              => 'Edit / Delete'
                    ];
                    break;
                case 'tutupbuka':
                    $index_data  = TutupBuka::sortable()->paginate(20);
                    $filters     = ['anak' => 'Staff'];
                    $table_head  = [
                        'id_tutupbuka'          => 'ID',
                        'anak.username'         => 'Staff',
                        'apps'                  => 'Apps',
                        'tanggal_tutup'         => 'Close Date',
                        'tanggal_buka'          => 'Open Date'
                    ];
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
                    $filters     = [];
                    $table_head  = [];
                    break;
                default:
                    $page        = '';
                    $index_data  = [];
                    $filters     = [];
                    $table_head  = [];
                    break;
            }

            list($filters, $table_head) = $this->prepareList($filters, $table_head);

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

    private function prepareList(array $filters, array $table_head)
    {
        $filters     = ContentPreparer::addChineseCharacter($filters);
        $table_head  = ContentPreparer::addChineseCharacter($table_head);
        
        return array($filters, $table_head);
    }
}
