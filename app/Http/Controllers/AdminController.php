<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminController extends Controller
{
    public function add(string $page)
    {
        if (view()->exists("admin.{$page}.{$page}_add")) {
            switch ($page) {
                default:
                    return view("admin.{$page}.{$page}_add");
            }
        }

        return abort(404);
    }

    public function save(string $page, Request $request)
    {
        switch ($page) {
            case 'account':
                $this->validate($request, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'level' => ['required', 'integer']
                ]);
                
                $user = User::create([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                    'level' => $request->get('level')
                ]);

                return back()->withSuccess('Add Successful');
                break;
            default:
                break;
        }
    }
}
