<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    public function login(Request $request){

        $pseudo = $request->input('pseudo', '');
        $password = $request->input('password', '');
        if (Auth::attempt([
            'pseudo' => $pseudo,
            'password' => $password,
        ])) {
            $junior= "junior";
            $senior = "senior";
            $employe = "employe";
            $user = User::where('pseudo',$pseudo)->first();
            $_SESSION['compte']['user_id'] = $user->id;
            if(User::with('groupes')->where('users.pseudo',$pseudo)->where('nom',$junior)->get()){
                return response()->json($_SESSION['compte']['user_id']);
            }
            if(User::with('groupes')->where('users.pseudo',$pseudo)->where('nom',$senior)->get()){
                return response()->json('senior');
            }
            if(User::with('groupes')->where('users.pseudo',$pseudo)->where('nom',$employe)->get()){
                return response()->json('employe');
            }
            }
        return response()->json("identifiant incorrect");
    }
    public function logout(){
        Auth::logout();
        return response()->json('deconnexion');
    }

    public function username()
    {
        return 'username';
    }
}