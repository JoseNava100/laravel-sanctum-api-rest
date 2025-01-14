<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GeneratePasswordController 
{
    public function password(){
        
        $password = '12345678'; 
        $encryptedPassword = Hash::make($password);
        $message = 'En el controlador de generar contraseña solo esta si deseas generar una contraseña e insertarla manualmente en la base de datos';

        return view('api', [
            'password' => $password,
            'encryptedPassword' => $encryptedPassword,
            'message' => $message,
        ]);
    }
}
