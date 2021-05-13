<?php

namespace App\Http\Controllers\AjaxElements;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Divisi;
use App\Leader;

class AjaxInput extends Controller
{
    public static function apiInputDivisi(string $page, string $id, string $e_id)
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
            $selected = ($divisi->id_divisi == $e_id) ? ' selected="selected"' : '';
            $row = '<option value="'. $divisi->id_divisi. '"'. $selected. '>'. $divisi->nama_divisi. '</option>';
            $html .= $row;
        }
        $html .= '
                    </select>
                </div>
            </div>
        </div>';

        return $html;
    }

    public static function apiInputLeader(string $page, string $id, string $e_id) {
        $leaders = Leader::where('id_apps', $id)->get();
        $html = '
        <div class="row row--leader">
            <label class="col-md-3 col-form-label">Leader</label>
            <div class="col-md-9">
                <div class="form-group">
                    <select id="select--leader" name="leader" class="form-control">
                        <option value="0"></option>';
        foreach ($leaders as $leader) {
            $selected = ($leader->id_leader == $e_id) ? ' selected="selected"' : '';
            $row = '<option value="'. $leader->id_leader. '"'. $selected. '>'. $leader->username. '</option>';
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
