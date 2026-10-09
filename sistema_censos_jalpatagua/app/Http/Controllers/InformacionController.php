<?php
namespace App\Http\Controllers;
use App\Models\Comunidad;
class InformacionController extends Controller {
    public function index(){ $comunidades=Comunidad::orderBy('nombre')->get(); $seleccionada=$comunidades->first(); return view('informacion.index',compact('comunidades','seleccionada')); }
    public function show(Comunidad $comunidad){ $comunidades=Comunidad::orderBy('nombre')->get(); $seleccionada=$comunidad->load('cocodes'); return view('informacion.index',compact('comunidades','seleccionada')); }
}
