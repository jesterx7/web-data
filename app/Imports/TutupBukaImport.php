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
            '*.nama_apps'               => ['string', 'exists:apps,nama_apps'],
            '*.username_anak'           => ['string', 'exists:anak,username']
        ])->validate();
        foreach ($rows as $key => $row) {
            $validator = new ImportValidator();
            if ($validator::anakExists($row['username_anak'], $row['nama_apps'])) {
                $anak = TutupBuka::create([
                    'tanggal_tutup' => Date::excelToDateTimeObject($row['tanggal_tutup'])->format('Y-m-d h:i:s'),
                    'tanggal_buka'  => Date::excelToDateTimeObject($row['tanggal_buka'])->format('Y-m-d h:i:s'),
                    'status'        => 'ON',
                    'id_anak'       => $this->getAnakId($row['username_anak'], $this->getAppsId($row['nama_apps']))
                ]);
            } else {
                return back()->withErrors(['Username Anak is Not Exsits on Its App in Row '. strval($key+2)]);
            }
        }
    }

    private function getAppsId($nama_apps)
    {
        return Apps::where('nama_apps', $nama_apps)
                    ->first()
                    ->id_apps;
    }

    private function getAnakId($username_anak, $id_apps)
    {
        return  Anak::where(['username' => $username_anak, 'id_apps' => $id_apps])
                        ->first()
                        ->id_anak;
    }

    public function rules(): array
    {
        return [
            '*.nama_apps'               => ['string', 'exists:apps,nama_apps'],
            '*.username_anak'           => ['string', 'exists:anak,username']
        ];
    }
}
