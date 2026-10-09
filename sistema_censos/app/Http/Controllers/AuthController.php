<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar pantalla de inicio de sesión
    public function show()
    {
        return view('auth.login');
    }
    // Procesar inicio de sesión
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Verificar que la cuenta esté activa
        $credenciales['activo'] = true;

        if (Auth::attempt($credenciales)) {

            // Regenerar la sesión por seguridad
            $request->session()->regenerate();

            // Ir a la pantalla principal
            return redirect()->route('inicio');
        }
        // Mostrar error si las credenciales son incorrectas
        // o si la cuenta está desactivada
        return back()
            ->withErrors([
                'email' => 'Credenciales incorrectas o cuenta desactivada.',
            ])
            ->onlyInput('email');
    }
    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
