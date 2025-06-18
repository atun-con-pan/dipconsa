<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Método para mostrar la página principal
    public function index()
    {
        return view('home');
    }
}
