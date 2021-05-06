<?php

namespace App\Imports;

use App\Apps;
use App\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AppsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Apps([
            'nama_apps'     => $row['nama_apps'],
            'link_apps'     => $row['link_apps'],
            'id_company'    => Company::where('nama_company', $row['nama_company'])
                                        ->first()
                                        ->id_company,
        ]);
    }
}
