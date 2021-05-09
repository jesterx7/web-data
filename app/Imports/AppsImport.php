<?php

namespace App\Imports;

use App\Apps;
use App\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AppsImport implements ToModel, WithHeadingRow, WithValidation
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

    public function rules(): array
    {
        return [
            '*.nama_apps'       => ['string', 'unique:apps,nama_apps'],
            '*.nama_company'    => ['string', 'exists:companies,nama_company'],
        ];
    }
}
