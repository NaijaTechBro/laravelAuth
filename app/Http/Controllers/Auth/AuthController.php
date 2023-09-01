<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Logout
    public function logout(){
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout Success',
            'status'=>'success'
        ], 200);
    }
    
    // LoggedUser
    public function logged_user(){
        $loggeduser = auth()->user();
        return response([
            'user'=>$loggeduser,
            'message' => 'Logged User Data',
            'status'=>'success'
        ], 200);
    }


}