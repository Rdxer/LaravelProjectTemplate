<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class InitServerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    function i_am_a_super_administrator()
    {

        try{
            $sadmin = Role::findByName("super-admin");
            $super = $sadmin;
        }catch (\Exception $e){
            app()['cache']->forget('spatie.permission.cache');

            $super = Role::create(['name' => 'super-admin']);
            $admin = Role::create(['name' => 'admin']);
        }

        $users = User::role('super-admin')->get();

        if ($users->count() != 0){
            return abort(404);
        }

        app()['cache']->forget('spatie.permission.cache');

        auth()->user()->assignRole($super);

        Letter::create([
            "user_id" => auth()->id(),
            "title" => "您已成为超级管理员",
            "details" => ""
        ]);

        return redirect(route('home'));
    }
}
