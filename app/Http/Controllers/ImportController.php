<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CompaniesImport;
use App\Imports\DivisiImport;
use App\Imports\LeaderImport;
use App\Imports\AppsImport;
use App\Imports\AnakImport;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function import(string $page, Request $request)
    {
        switch ($page) {
            case 'company':
                Excel::import(new CompaniesImport, request()->file('file'));
                break;
            case 'aplikasi':
                Excel::import(new AppsImport, request()->file('file'));
                break;
            case 'divisi':
                Excel::import(new DivisiImport, request()->file('file'));
                break;
            case 'leader':
                Excel::import(new LeaderImport, request()->file('file'));
                break;
            case 'anak':
                Excel::import(new AnakImport, request()->file('file'));
                break;
            default:
                break;
        }

        return back();
    }
}
