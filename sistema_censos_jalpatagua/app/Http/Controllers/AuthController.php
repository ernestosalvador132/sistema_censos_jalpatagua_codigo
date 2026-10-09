<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function show(){ return view('auth.login'); }
    public function login(Request $request){
        $cred=$request->validate(['email'=>'required|email','password'=>'required']);
        if(Auth::attempt($cred)){ $request->session()->regenerate(); return redirect()->route('inicio'); }
        return back()->withErrors(['email'=>'Credenciales incorrectas.'])->onlyInput('email');
    }
    public function logout(Request $request){ Auth::logout(); $request->session()->invalidate(); $request->session()->regenerateToken(); return redirect()->route('login'); }
}
