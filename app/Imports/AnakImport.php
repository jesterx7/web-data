<?php

namespace App\Imports;

use App\Anak;
use App\Apps;
use App\Divisi;
use App\Leader;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnakImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Anak([
            'username'  => $row['username'],
            'password'  => $row['password'],
            'status'    => 'ON',
            'id_divisi' => $this->getDivisiId($row['nama_divisi'], $this->getAppsId($row['nama_apps'])),
            'id_leader' => $this->getLeaderId($row['username_leader'], $this->getAppsId($row['nama_apps'])),
        ]);
    }

    private function getAppsId($nama_apps)
    {
        return Apps::where('nama_apps', $nama_apps)
                    ->first()
                    ->id_apps;
    }

    private function getDivisiId($nama_divisi, $id_apps)
    {
        return  Divisi::where(['nama_divisi' => $nama_divisi, 'id_apps' => $id_apps])
                        ->first()
                        ->id_divisi;
    }

    private function getLeaderId($username_leader, $id_apps)
    {
        return  Leader::where(['username' => $username_leader, 'id_apps' => $id_apps])
                        ->first()
                        ->id_leader;
    }
}
