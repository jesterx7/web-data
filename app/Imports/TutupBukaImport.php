<?php

namespace App\Imports;

use App\TutupBuka;
use App\Apps;
use App\Anak;
use App\Http\Controllers\ImportValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TutupBukaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nama_apps'               => ['required', 'exists:apps,nama_apps'],
            '*.username_anak'           => ['required', 'exists:anak,username']
        ])->validate();
        foreach ($rows as $key => $row) {
            $errors = ImportValidator::validateData('tutupbuka', $row, $key);
            if (count($errors) == 0) {
                $tutupbuka = TutupBuka::create([
                    'tanggal_tutup' => Date::excelToDateTimeObject($row['tanggal_tutup'])->format('Y-m-d h:i:s'),
                    'tanggal_buka'  => Date::excelToDateTimeObject($row['tanggal_buka'])->format('Y-m-d h:i:s'),
                    'status'        => 'ON',
                    'id_anak'       => ImportValidator::getAnakId($row['username_anak'], ImportValidator::getAppsId($row['nama_apps']))
                ]);
            } else {
                return back()->withErrors([$errors]);
            }
        }
    }
}
