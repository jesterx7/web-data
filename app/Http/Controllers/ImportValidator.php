<?php

namespace App\Http\Controllers;

use App\Apps;
use App\Anak;
use App\Divisi;
use App\Leader;
use Illuminate\Http\Request;

class ImportValidator extends Controller
{
    public static function divisiExists($nama_divisi, $apps)
    {
        $divisi = Divisi::where([
                            ['nama_divisi', '=', $nama_divisi],
                            ['id_apps', '=', Apps::where('nama_apps', $apps)->first()->id_apps]
                        ])->first();
        return ($divisi) ? true : false;
    }

    public static function leaderExists($username, $apps)
    {
        $leader = Leader::where([
                            ['username', '=', $username],
                            ['id_apps', '=', Apps::where('nama_apps', $apps)->first()->id_apps]
                        ])->first();
        return ($leader) ? true : false;
    }

    public static function anakExists($username, $apps)
    {
        $anak = Anak::where([
                        ['username', '=', $username],
                        ['id_apps', '=', Apps::where('nama_apps', $apps)->first()->id_apps]
                    ])->first();
        return ($anak) ? true : false;
    }
}
