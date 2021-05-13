<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
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
                    $index_data  = Company::where('status', 'ON')->sortable()->paginate(20);
                    $filters     = ['nama_company' => 'Company'];
                    break;
                case 'aplikasi':
                    $index_data  = Apps::where('status', 'ON')->sortable()->paginate(20);
                    $filters     = ['nama_apps' => 'Aplikasi', 'link' => 'Link Apps', 'nama_company' => 'Company'];
                    break;
                case 'divisi':
                    $index_data  = Divisi::where('status', 'ON')->sortable()->paginate(20);
                    $filters     = ['nama_divisi' => 'Divisi', 'nama_aplikasi' => 'Aplikasi'];
                    break;
                case 'leader':
                    $index_data  = Leader::where('status', 'ON')->sortable()->paginate(20);
                    $filters     = ['username' => 'Username', 'nama_aplikasi' => 'Aplikasi'];
                    break;
                case 'anak':
                    $index_data  = Anak::where('status', 'ON')->sortable()->paginate(20);
                    $filters     = ['username' => 'Username', 'nama_aplikasi' => 'Aplikasi', 'divisi' => 'Divisi', 'leader' => 'Leader'];
                    break;
                case 'tutupbuka':
                    $index_data  = TutupBuka::sortable()->paginate(20);
                    $filters     = ['anak' => 'Anak'];
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
                    break;
                default:
                    $page        = '';
                    $index_data  = [];
                    $filters     = [];
                    break;
            }

            return view("pages.{$page}.{$page}_list", ["index_data" => $index_data, "filters" => $filters, 'page' => $page]);
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

    public function save(string $page, Request $request) {
        switch ($page) {
            case 'company':
                $this->saveCompany($request);
                break;
            case 'aplikasi':
                $this->saveAplikasi($request);
                break;
            case 'divisi':
                $this->saveDivisi($request);
                break;
            case 'leader':
                $this->saveLeader($request);
                break;
            case 'anak':
                $this->saveAnak($request);
                break;
            default:
                break;
        }

        return $this->index($page);
    }

    public function saveCompany(Request $request) {
        $this->validate($request, [
            'nama_company'  => 'required'
        ]);

        $company = new Company;
        $company->nama_company = $request->get('nama_company');
        
        return $company->save();
    }

    public function saveAplikasi(Request $request) {
        $this->validate($request, [
            'nama_aplikasi' => 'required',
            'company'       => 'required'
        ]);

        $apps = new Apps;
        $apps->nama_apps        = $request->get('nama_aplikasi');
        $apps->link_apps        = $request->get('link');
        $apps->id_company       = $request->get('company');

        return $apps->save();
    }

    public function saveDivisi(Request $request) {
        $this->validate($request, [
            'nama_divisi'   => 'required',
            'apps'          => 'required'
        ]);

        $divisi = new Divisi;
        $divisi->nama_divisi    = $request->get('nama_divisi');
        $divisi->id_apps        = $request->get('apps');
        $divisi->status         = 'ON';

        return $divisi->save();
    }

    public function saveLeader(Request $request) {
        $this->validate($request, [
            'username'  => 'required',
            'password'  => 'required',
            'apps'      => 'required'   
        ]);

        $leader = new Leader;
        $leader->username   = $request->get('username');
        $leader->password   = $request->get('password');
        $leader->id_apps    = $request->get('apps');
        $leader->status     = 'ON';

        return $leader->save();
    }

    public function saveAnak(Request $request) {
        $this->validate($request, [
            'username'  => 'required',
            'password'  => 'required',
            'apps'      => 'required|not_in:0',
            'divisi'    => 'required|not_in:0',
            'leader'    => 'required|not_in:0'
        ]);

        $anak = new Anak;
        $anak->username     = $request->get('username');
        $anak->password     = $request->get('password');
        $anak->id_apps      = $request->get('apps');
        $anak->id_divisi    = $request->get('divisi');
        $anak->id_leader    = $request->get('leader');
        $anak->status       = 'ON';

        return $anak->save();
    }
}
