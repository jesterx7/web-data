<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Divisi;
use App\Leader;

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
}
