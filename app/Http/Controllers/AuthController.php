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

            $user = User::with('groupes')->where('pseudo','=',$pseudo)->get()->first();

            $_SESSION['compte']['user_id'] = $user->id;

            if($user->groupes[0]->nom == "junior"){
                return response()->json('junior');
            }
            if($user->groupes[0]->nom == "senior"){
                return response()->json('senior');
            }
            if($user->groupes[0]->nom == "employe"){
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