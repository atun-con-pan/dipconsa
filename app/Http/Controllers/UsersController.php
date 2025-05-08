<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Método para mostrar la página usuarios
    public function users()
    {
        return view('usuarios');  // Devuelve la vista 'home.blade.php'
    }
}
