<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listUser()
    {
//        $user = new User();
//        $user->name = "teste laravel";
//        $user->email = "luis@test.com";
//        $user->password = Hash::make('1235');
//        $user->save();
        
//        echo "<h1>Listagem de Usuario!</h1>";
        
        $user = User::where('id', '=', 1)->first();
        
        return view('listUser', [
            'user' => $user
        ]);
    }
}
