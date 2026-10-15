<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaludoController extends Controller
{
    public function saludar()
    {
        return view('saludo', ['mensaje' => '¡Hola Mundo desde Laravel!']);
    }
}