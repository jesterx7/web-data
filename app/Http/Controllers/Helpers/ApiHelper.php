<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $validator = Validator::make($request->all(), [
            'nama_company'  => 'required|unique:companies,nama_company'
        ]);
        if ($validator->fails())
        {
            return $validator->errors();
        }

        $company->nama_company = $request->get('nama_company');
        $company->save();

        return $validator->errors();
    }

    public static function saveAplikasi(Request $request, Apps $apps) {
        $validator = Validator::make($request->all(), [
            'nama_aplikasi' => 'required|unique:apps,nama_apps',
            'company'       => 'required'
        ]);

        if ($validator->fails())
        {
            return $validator->errors();
        }

        $apps->nama_apps        = $request->get('nama_aplikasi');
        $apps->link_apps        = $request->get('link');
        $apps->id_company       = $request->get('company');
        $apps->save();

        return $validator->errors();
    }

    public static function saveDivisi(Request $request, Divisi $divisi) {
        $validator = Validator::make($request->all(), [
            'apps'          => 'required',
            'nama_divisi'   => ['required', Rule::unique('divisi')->where(function ($query) use ($request) {
                return $query->where('nama_divisi', $request->get('nama_divisi'))->where('id_apps', $request->get('apps'));
            })]
        ]);

        if ($validator->fails())
        {
            return $validator->errors();
        }

        $divisi->nama_divisi    = $request->get('nama_divisi');
        $divisi->id_apps        = $request->get('apps');
        $divisi->status         = 'ON';
        $divisi->save();

        return $validator->errors();
    }

    public static function saveLeader(Request $request, Leader $leader) {
        $validator = Validator::make($request->all(), [
            'password'  => 'required',
            'apps'      => 'required',
            'username'  => ['required', Rule::unique('leaders')->where(function ($query) use ($request) {
                return $query->where('username', $request->get('username'))->where('id_apps', $request->get('apps'));
            })]
        ]);

        if ($validator->fails())
        {
            return $validator->errors();
        }

        $leader->username   = $request->get('username');
        $leader->password   = $request->get('password');
        $leader->id_apps    = $request->get('apps');
        $leader->status     = 'ON';
        $leader->save();

        return $validator->errors();
    }

    public static function saveAnak(Request $request, Anak $anak) {
        $validator = Validator::make($request->all(), [
            'password'  => 'required',
            'apps'      => 'required|not_in:0',
            'divisi'    => 'required|not_in:0',
            'leader'    => 'required|not_in:0',
            'username'  => ['required', Rule::unique('anak')->where(function ($query) use ($request) {
                return $query->where('username', $request->get('username'))->where('id_apps', $request->get('apps'));
            })]
        ]);

        if ($validator->fails())
        {
            return $validator->errors();
        }
        
        $anak->username     = $request->get('username');
        $anak->password     = $request->get('password');
        $anak->id_apps      = $request->get('apps');
        $anak->id_divisi    = $request->get('divisi');
        $anak->id_leader    = $request->get('leader');
        $anak->status       = 'ON';
        $anak->save();

        return $validator->errors();
    }

    public static function saveTutupBuka(Request $request, TutupBuka $tutupbuka) {
        Validator::make($request->all(), [
            'close_date'    => 'required',
            'open_date'     => 'required'
        ]);
        
        $tutupbuka->tanggal_tutup        = $request->get('close_date');
        $tutupbuka->tanggal_buka         = $request->get('open_date');
        $tutupbuka->status               = 'ON';

        return $tutupbuka->save();
    }
}
