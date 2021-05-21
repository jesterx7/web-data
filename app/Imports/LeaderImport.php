<?php

namespace App\Imports;

use App\Leader;
use App\Apps;
use App\Http\Controllers\ImportValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeaderImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nama_apps'    => ['required', 'exists:apps,nama_apps']
        ])->validate();
        foreach ($rows as $key => $row) {
            $errors = ImportValidator::validateData('leader', $row, $key);
            if (count($errors) == 0) {
                $leader = Leader::create([
                    'username'  => $row['username'],
                    'password'  => $row['password'],
                    'status'    => 'ON',
                    'id_apps'   => ImportValidator::getAppsId($row['nama_apps'])
                ]);
            } else {
                return back()->withErrors([$errors]);
            }
        }
    }
}
