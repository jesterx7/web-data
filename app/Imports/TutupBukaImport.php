<?php

namespace App\Imports;

use App\TutupBuka;
use App\Apps;
use App\Anak;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TutupBukaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TutupBuka([
            'tanggal_tutup' => Date::excelToDateTimeObject($row['tanggal_tutup'])->format('Y-m-d h:i:s'),
            'tanggal_buka'  => Date::excelToDateTimeObject($row['tanggal_buka'])->format('Y-m-d h:i:s'),
            'status'        => 'ON',
            'id_anak'       => $this->getAnakId($row['username_anak'], $this->getAppsId($row['nama_apps']))
        ]);
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
}
