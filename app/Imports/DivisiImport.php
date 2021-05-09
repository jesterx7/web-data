<?php

namespace App\Imports;

use App\Divisi;
use App\Apps;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DivisiImport implements ToModel, WithHeadingRow, WithValidation
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

    public function rules(): array
    {
        return [
            '*.nama_apps'    => ['string', 'exists:apps,nama_apps']
        ];
    }
}
