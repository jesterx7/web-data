<?php

namespace App\Http\Controllers;

use App\Apps;
use App\Anak;
use App\Divisi;
use App\Leader;
use Illuminate\Http\Request;

class ImportValidator extends Controller
{
    public static function divisiExists($nama_divisi, $apps)
    {
        $divisi = Divisi::where([
                            ['nama_divisi', '=', $nama_divisi],
                            ['id_apps', '=', Apps::where('nama_apps', $apps)->first()->id_apps]
                        ])->first();
        return ($divisi) ? '' : 'Divisi not exists';
    }

    public static function leaderExists($username, $apps)
    {
        $leader = Leader::where([
                            ['username', '=', $username],
                            ['id_apps', '=', Apps::where('nama_apps', $apps)->first()->id_apps]
                        ])->first();
        return ($leader) ? '' : 'Leader not exists';
    }

    public static function anakExists($username, $apps)
    {
        $anak = Anak::where([
                        ['username', '=', $username],
                        ['id_apps', '=', Apps::where('nama_apps', $apps)->first()->id_apps]
                    ])->first();
        return ($anak) ? '' : 'Staff not exists';
    }

    public static function isNotDuplicate($model_name, $where_conditions)
    {
        $model = 'App\\'. $model_name;
        $where = '';
        foreach ($where_conditions as $key => $condition) {
            $where .= ($key === array_key_first($where_conditions)) ? $key. " = '". $condition. "' " : "AND ". $key. " = '". $condition. "' " ;
        }
        
        $data = $model::whereRaw($where)->first();
        return ($data) ? 'Data is duplicated' : '';
    }
    
    public static function validateData($page, $row, $key)
    {
        switch ($page) {
            case 'anak':
                $errors = self::validateAnak($row);
                break;
            case 'divisi':
                $errors = self::validateDivisi($row);
                break;
            case 'leader':
                $errors = self::validateLeader($row);
                break;
            case 'tutupbuka':
                $errors = self::validateTutupBuka($row);
                break;
            default:
                $errors = [];
        }

        $errors = self::addIndexError($errors, $key);

        return $errors;
    }

    private static function validateAnak($row)
    {
        $errors      = [];
        $validator   = new ImportValidator();
        $errors[]    = $validator::divisiExists($row['nama_divisi'], $row['nama_apps']);
        $errors[]    = $validator::leaderExists($row['username_leader'], $row['nama_apps']);
        $errors[]    = $validator::isNotDuplicate('Anak', ['username' => $row['username'], 'id_apps' => self::getAppsId($row['nama_apps'])]);

        return array_filter($errors);
    }

    private static function validateDivisi($row)
    {
        $errors      = [];
        $validator   = new ImportValidator();
        $errors[]    = $validator::isNotDuplicate('Divisi', ['nama_divisi' => $row['nama_divisi'], 'id_apps' => self::getAppsId($row['nama_apps'])]);

        return array_filter($errors);
    }

    private static function validateLeader($row)
    {
        $errors      = [];
        $validator   = new ImportValidator();
        $errors[]    = $validator::isNotDuplicate('Leader', ['username' => $row['username'], 'id_apps' => self::getAppsId($row['nama_apps'])]);

        return array_filter($errors);
    }

    private static function validateTutupBuka($row)
    {
        $errors      = [];
        $validator   = new ImportValidator();
        $errors[]    = $validator::anakExists($row['username_anak'], $row['nama_apps']);

        return array_filter($errors);
    }

    private static function addIndexError($errors, $index)
    {
        foreach ($errors as $key => $error)
        {
            $errors[$key] = $error. ' in row '. strval($index+2);
        }

        return $errors;
    }

    public static function getAppsId($nama_apps)
    {
        return Apps::where('nama_apps', $nama_apps)
                    ->first()
                    ->id_apps;
    }

    public static function getDivisiId($nama_divisi, $id_apps)
    {
        return  Divisi::where(['nama_divisi' => $nama_divisi, 'id_apps' => $id_apps])
                        ->first()
                        ->id_divisi;
    }

    public static function getLeaderId($username_leader, $id_apps)
    {
        return  Leader::where(['username' => $username_leader, 'id_apps' => $id_apps])
                        ->first()
                        ->id_leader;
    }

    public static function getAnakId($username_anak, $id_apps)
    {
        return  Anak::where(['username' => $username_anak, 'id_apps' => $id_apps])
                        ->first()
                        ->id_anak;
    }
}
