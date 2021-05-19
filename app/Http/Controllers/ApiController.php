<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\ApiHelper;
use App\Http\Controllers\AjaxElements\AjaxInput;
use App\Apps;
use App\Anak;
use App\Divisi;
use App\Leader;
use App\Company;
use App\TutupBuka;
use Carbon\Carbon;

class ApiController extends Controller
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
    
     public function apiAjax(string $page, string $id, string $e_id)
     {
        switch ($page) {
            case 'divisi':
                return AjaxInput::apiInputDivisi($page, $id, $e_id);
                break;
            case 'leader':
                return AjaxInput::apiInputLeader($page, $id, $e_id);
                break;
            default:
                break;
        }

        return '';
     }

    public function apiTutupBuka(string $page, string $id, Request $request)
    {
        $this->validate($request, [
            'action'    => 'required'
        ]);

        if ($request->get('action') == 'tutup') {
            $tutupbuka                  = new TutupBuka;
            $tutupbuka->tanggal_tutup   = Carbon::now();
            $tutupbuka->status          = 'ON';
            $tutupbuka->tanggal_buka    = '9999-12-31 00:00:00';
            $tutupbuka->id_anak         = $id;
        } else {
            $tutupbuka = TutupBuka::where('id_anak', $id)->orderBy('id_tutupbuka', 'desc')->first();
            $tutupbuka->tanggal_buka = Carbon::now();
        }
        if ($tutupbuka->save()) {
            return back();
        } else {
            return back()->withErrors(['msg', 'Error when update TutupBuka']);
        }
    }

    public function apiDelete(string $page, string $id)
    {
        switch ($page) {
            case 'company':
                $deleteData = Company::where('id_company', $id)->first();
                $deleteData->status = 'OFF';
                $deleteData->save();
                break;
            case 'aplikasi':
                $deleteData = Apps::where('id_apps', $id)->first();
                $deleteData->status = 'OFF';
                $deleteData->save();
                break;
            case 'divisi':
                $deleteData = Divisi::where('id_divisi', $id)->first();
                $deleteData->status = 'OFF';
                $deleteData->save();
                break;
            case 'leader':
                $deleteData = Leader::where('id_leader', $id)->first();
                $deleteData->status = 'OFF';
                $deleteData->save();
                break;
            case 'anak':
                $deleteData = Anak::where('id_anak', $id)->first();
                $deleteData->status = 'OFF';
                $deleteData->save();
                break;
            case 'tutupbuka':
                $deleteData = TutupBuka::where('id_tutupbuka', $id)->first();
                $deleteData->status = 'OFF';
                $deleteData->save();
                break;
            default:
                break;
        }

        return back();
    }

    public function apiEdit(string $page, string $id, Request $request)
    {
        switch ($page) {
            case 'company':
                $editData = Company::where('id_company', $id)->first();
                ApiHelper::saveCompany($request, $editData);
                break;
            case 'anak':
                $editData = Anak::where('id_anak', $id)->first();
                ApiHelper::saveAnak($request, $editData);
                break;
            case 'aplikasi':
                $editData = Apps::where('id_apps', $id)->first();
                ApiHelper::saveAplikasi($request, $editData);
                break;
            case 'leader':
                $editData = Leader::where('id_leader', $id)->first();
                ApiHelper::saveLeader($request, $editData);
                break;
            case 'divisi':
                $editData = Divisi::where('id_divisi', $id)->first();
                ApiHelper::saveDivisi($request, $editData);
                break;
            case 'tutupbuka':
                $editData = TutupBuka::where('id_tutupbuka', $id)->first();
                ApiHelper::saveTutupBuka($request, $editData);
                break;
            default:
                break;
        }

        return redirect()->route('page.index', $page);
    }
}
