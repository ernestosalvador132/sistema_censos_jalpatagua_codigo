<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UsuarioController extends Controller {
    public function index(){ abort_unless(auth()->user()->rol==='ADMINISTRADOR',403); $usuarios=User::orderBy('name')->get(); return view('administracion.usuarios',compact('usuarios')); }
    public function store(Request $request){ abort_unless(auth()->user()->rol==='ADMINISTRADOR',403); $d=$request->validate(['name'=>'required|max:120','email'=>'required|email|unique:users','password'=>'required|min:8','rol'=>'required|in:ADMINISTRADOR,DIGITADOR']); User::create(['name'=>$d['name'],'email'=>$d['email'],'password'=>Hash::make($d['password']),'rol'=>$d['rol']]); return back()->with('ok','Usuario creado correctamente.'); }
}
