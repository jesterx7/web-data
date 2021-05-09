<?php

namespace App\Imports;

use App\Anak;
use App\Apps;
use App\Divisi;
use App\Leader;
use App\Http\Controllers\ImportValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnakImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.nama_apps'               => ['string', 'exists:apps,nama_apps'],
            '*.nama_divisi'             => ['string', 'exists:divisi,nama_divisi'],
            '*.username_leader'         => ['string', 'exists:leaders,username']
        ])->validate();
        foreach ($rows as $key => $row) {
            $validator = new ImportValidator();
            if ($validator::divisiExists($row['nama_divisi'], $row['nama_apps']) && 
                $validator::leaderExists($row['username_leader'], $row['nama_apps'])) {
                $anak = Anak::create([
                    'username'  => $row['username'],
                    'password'  => $row['password'],
                    'status'    => 'ON',
                    'id_apps'   => $this->getAppsId($row['nama_apps']),
                    'id_divisi' => $this->getDivisiId($row['nama_divisi'], $this->getAppsId($row['nama_apps'])),
                    'id_leader' => $this->getLeaderId($row['username_leader'], $this->getAppsId($row['nama_apps'])),
                ]);
            } else {
                return back()->withErrors(['Divisi / Leader is Not Exsits on Its App in Row '. strval($key+2)]);
            }
        }
    }

    private function getAppsId($nama_apps)
    {
        return Apps::where('nama_apps', $nama_apps)
                    ->first()
                    ->id_apps;
    }

    private function getDivisiId($nama_divisi, $id_apps)
    {
        return  Divisi::where(['nama_divisi' => $nama_divisi, 'id_apps' => $id_apps])
                        ->first()
                        ->id_divisi;
    }

    private function getLeaderId($username_leader, $id_apps)
    {
        return  Leader::where(['username' => $username_leader, 'id_apps' => $id_apps])
                        ->first()
                        ->id_leader;
    }
}
