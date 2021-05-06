<?php

namespace App\Imports;

use App\Divisi;
use App\Apps;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DivisiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Divisi([
            'nama_divisi'   => $row['nama_divisi'],
            'status'        => 'ON',
            'id_apps'       => Apps::where('nama_apps', $row['nama_apps'])
                                        ->first()
                                        ->id_apps
        ]);
    }
}
