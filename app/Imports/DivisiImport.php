<?php

namespace App\Imports;

use App\Divisi;
use App\Apps;
use App\Http\Controllers\ImportValidator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DivisiImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nama_apps'    => ['required', 'exists:apps,nama_apps']
        ])->validate();
        foreach ($rows as $key => $row) {
            $errors = ImportValidator::validateData('divisi', $row, $key);
            if (count($errors) == 0) {
                $divisi = Divisi::create([
                    'nama_divisi'   => $row['nama_divisi'],
                    'status'        => 'ON',
                    'id_apps'       => ImportValidator::getAppsId($row['nama_apps'])
                ]);
            } else {
                return back()->withErrors([$errors]);
            }
        }
    }
}
