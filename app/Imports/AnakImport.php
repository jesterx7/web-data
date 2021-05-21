<?php

namespace App\Imports;

use App\Anak;
use App\Apps;
use App\Divisi;
use App\Leader;
use App\TutupBuka;
use Carbon\Carbon;
use App\Http\Controllers\ImportValidator;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnakImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nama_apps'               => ['required', 'exists:apps,nama_apps'],
            '*.nama_divisi'             => ['required', 'exists:divisi,nama_divisi'],
            '*.username_leader'         => ['required', 'exists:leaders,username'],
            '*.tanggal_buka'            => ['nullable']
        ])->validate();
        foreach ($rows as $key => $row) {
            $errors = ImportValidator::validateData('anak', $row, $key);
            if (count($errors) == 0) {
                $anak = Anak::create([
                    'username'  => $row['username'],
                    'password'  => $row['password'],
                    'status'    => 'ON',
                    'id_apps'   => ImportValidator::getAppsId($row['nama_apps']),
                    'id_divisi' => ImportValidator::getDivisiId($row['nama_divisi'], ImportValidator::getAppsId($row['nama_apps'])),
                    'id_leader' => ImportValidator::getLeaderId($row['username_leader'], ImportValidator::getAppsId($row['nama_apps'])),
                ]);
                
                $tutupbuka = TutupBuka::create([
                    'tanggal_tutup' => '9999-12-31 00:00:00',
                    'tanggal_buka'  => ($row['tanggal_buka'] == null || empty($row['tanggal_buka'])) ? Carbon::now() : Date::excelToDateTimeObject($row['tanggal_buka'])->format('Y-m-d h:i:s'),
                    'status'        => 'ON',
                    'id_anak'       => Anak::where('username', $anak->username)->where('id_apps', $anak->id_apps)->first()->id_anak
                ]);
            } else {
                return back()->withErrors([$errors]);
            }
        }
    }
}
