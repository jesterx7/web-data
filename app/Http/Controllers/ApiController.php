<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function apiDivisi(string $page, string $id)
    {
        $divisis = Divisi::where('id_apps', $id)->get();
        $html = '
        <div class="row row--divisi">
            <label class="col-md-3 col-form-label">Divisi</label>
            <div class="col-md-9">
                <div class="form-group">
                    <select id="select--divisi" name="divisi" class="form-control">
                        <option value="0"></option>';
        foreach ($divisis as $divisi) {
            $row = '<option value="'. $divisi->id_divisi. '">'. $divisi->nama_divisi. '</option>';
            $html .= $row;
        }
        $html .= '
                    </select>
                </div>
            </div>
        </div>';

        return $html;
    }

    public function apiLeader(string $page, string $id) {
        $leaders = Leader::where('id_apps', $id)->get();
        $html = '
        <div class="row row--leader">
            <label class="col-md-3 col-form-label">Leader</label>
            <div class="col-md-9">
                <div class="form-group">
                    <select id="select--leader" name="leader" class="form-control">
                        <option value="0"></option>';
        foreach ($leaders as $leader) {
            $row = '<option value="'. $leader->id_leader. '">'. $leader->username. '</option>';
            $html .= $row;
        }
        $html .= '
                    </select>
                </div>
            </div>
        </div>';

        return $html;
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
            default:
                break;
        }

        return back();
    }
}
