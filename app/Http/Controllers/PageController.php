<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Divisi;
use App\Apps;

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
                    $index_data = Company::all();
                    break;
                case 'aplikasi':
                    $index_data = Apps::all();
                    break;
                case 'divisi':
                    $index_data = Divisi::all();
                    break;
                default:
                    $index_data = [];
                    break;
            }

            return view("pages.{$page}.{$page}_list", ["index_data" => $index_data]);
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
}
