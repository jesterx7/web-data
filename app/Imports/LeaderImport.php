<?php

namespace App\Imports;

use App\Leader;
use App\Apps;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeaderImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Leader([
            'username'  => $row['username'],
            'password'  => $row['password'],
            'status'    => 'ON',
            'id_apps'   => Apps::where('nama_apps', $row['nama_apps'])
                                    ->first()
                                    ->id_apps
        ]);
    }
}
