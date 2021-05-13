<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TutupBuka;
use App\Company;
use App\Leader;
use App\Divisi;
use App\Apps;
use App\Anak;

class ApiHelper extends Controller
{
    public static function saveCompany(Request $request, Company $company) {
        Validator::make($request->all(), [
            'nama_company'  => 'required'
        ]);

        $company->nama_company = $request->get('nama_company');
        
        return $company->save();
    }

    public static function saveAplikasi(Request $request, Apps $apps) {
        Validator::make($request->all(), [
            'nama_aplikasi' => 'required',
            'company'       => 'required'
        ]);

        $apps->nama_apps        = $request->get('nama_aplikasi');
        $apps->link_apps        = $request->get('link');
        $apps->id_company       = $request->get('company');

        return $apps->save();
    }

    public static function saveDivisi(Request $request, Divisi $divisi) {
        Validator::make($request->all(), [
            'nama_divisi'   => 'required',
            'apps'          => 'required'
        ]);

        $divisi->nama_divisi    = $request->get('nama_divisi');
        $divisi->id_apps        = $request->get('apps');
        $divisi->status         = 'ON';

        return $divisi->save();
    }

    public static function saveLeader(Request $request, Leader $leader) {
        Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
            'apps'      => 'required'   
        ]);

        $leader->username   = $request->get('username');
        $leader->password   = $request->get('password');
        $leader->id_apps    = $request->get('apps');
        $leader->status     = 'ON';

        return $leader->save();
    }

    public static function saveAnak(Request $request, Anak $anak) {
        Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
            'apps'      => 'required|not_in:0',
            'divisi'    => 'required|not_in:0',
            'leader'    => 'required|not_in:0'
        ]);
        
        $anak->username     = $request->get('username');
        $anak->password     = $request->get('password');
        $anak->id_apps      = $request->get('apps');
        $anak->id_divisi    = $request->get('divisi');
        $anak->id_leader    = $request->get('leader');
        $anak->status       = 'ON';

        return $anak->save();
    }
}
