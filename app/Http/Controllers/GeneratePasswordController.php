<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GeneratePasswordController 
{
    public function password(){
        
        $password = '12345678'; 
        $encryptedPassword = Hash::make($password);

        return view('api', [
            'password' => $password,
            'encryptedPassword' => $encryptedPassword,
        ]);
    }
}
