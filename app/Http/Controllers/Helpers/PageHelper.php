<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Preparer\ContentPreparer;

class PageHelper extends Controller
{
    private static function prepareList(array $filters, array $table_head)
    {
        $filters     = ContentPreparer::addChineseCharacterToFilter($filters);
        $table_head  = ContentPreparer::addChineseCharacterToHead($table_head);
        
        return array($filters, $table_head);
    }

    public static function build_data_table($page)
    {
        switch ($page) {
            case 'company':
                $filters     = [
                    'nama_company' => ['name' => 'Company', 'relational' => false, 'relation_name' => '']
                ];
                $table_head  = [
                    'id_company'    => 'ID',
                    'nama_company'  => 'Company',
                    'del_edit'      => 'Edit / Delete'
                ];
                break;
            case 'aplikasi':
                $filters     = [
                    'nama_apps' => ['name' => 'Apps', 'relational' => false, 'relation_name' => ''],
                    'link_apps' => ['name' => 'Link', 'relational' => false, 'relation_name' => ''],
                    'nama_company' => ['name' => 'Company', 'relational' => true, 'relation_name' => 'companies']
                ];
                $table_head  = [
                    'id_apps'                   => 'ID',
                    'nama_apps'                 => 'Apps',
                    'link_apps'                 => 'Link',
                    'companies.nama_company'    => 'Company',
                    'del_edit'                  => 'Edit / Delete'
                ];
                break;
            case 'divisi':
                $filters     = [
                    'nama_divisi' => ['name' => 'Division', 'relational' => false, 'relation_name' => ''],
                    'nama_apps' => ['name' => 'Apps', 'relational' => true, 'relation_name' => 'apps']
                ];
                $table_head  = [
                    'id_divisi'         => 'ID',
                    'nama_divisi'       => 'Division',
                    'apps.nama_apps'    => 'Apps',
                    'del_edit'          => 'Edit / Delete'
                ];
                break;
            case 'leader':
                $filters     = [
                    'username' => ['name' => 'Username', 'relational' => false, 'relation_name' => ''],
                    'nama_apps' => ['name' => 'Apps', 'relational' => true, 'relation_name' => 'apps']
                ];
                $table_head  = [
                    'id_leader'         => 'ID',
                    'username'          => 'Username',
                    'password'          => 'Password',
                    'apps.nama_apps'    => 'Apps',
                    'del_edit'          => 'Edit / Delete'
                ];
                break;
            case 'anak':
                $filters     = [
                    'username' => ['name' => 'Username', 'relational' => false, 'relation_name' => ''],
                    'nama_apps' => ['name' => 'Apps', 'relational' => true, 'relation_name' => 'apps'],
                    'nama_divisi' => ['name' => 'Division', 'relational' => true, 'relation_name' => 'divisi'],
                    'leaders.username' => ['name' => 'Leader', 'relational' => true, 'relation_name' => 'leaders']
                ];
                $table_head  = [
                    'id_anak'               => 'ID',
                    'username'              => 'Username',
                    'password'              => 'Password',
                    'divisi.nama_divisi'    => 'Division',
                    'apps.nama_apps'        => 'Apps',
                    'close_open'            => 'Close/Open',
                    'action'                => 'Action',
                    'del_edit'              => 'Edit / Delete'
                ];
                break;
            case 'tutupbuka':
                $filters     = [
                    'username' => ['name' => 'Staff', 'relational' => true, 'relation_name' => 'anak'],
                    'nama_apps' => ['name' => 'Apps', 'relational' => true, 'relation_name' => 'anak.apps']
                ];
                $table_head  = [
                    'id_tutupbuka'          => 'ID',
                    'anak.username'         => 'Staff',
                    'apps'                  => 'Apps',
                    'tanggal_tutup'         => 'Close Date',
                    'tanggal_buka'          => 'Open Date',
                    'del_edit'              => 'Edit / Delete'
                ];
                break;
            default:
                $filters     = [];
                $table_head  = [];
                break;
        }

        return PageHelper::prepareList($filters, $table_head);
    }
}
