<?php

namespace App\Http\Controllers;

class InformacionController extends Controller
{
    public function index()
    {
        $comunidades = config('cocodes');

        return view('informacion.index', compact('comunidades'));
    }
}
