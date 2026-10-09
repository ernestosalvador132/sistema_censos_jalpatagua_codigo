<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class AdministracionController extends Controller
{
    // Mostrar usuarios registrados
    public function index()
    {
        $usuarios = User::orderBy('name')->get();

        return view('administracion.index', compact('usuarios'));
    }
    // Registrar un nuevo usuario
    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|in:administrador,usuario',
        ]);
        User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => $datos['password'],
            'rol' => $datos['rol'],
            'activo' => true,
        ]);
        return redirect()
            ->route('administracion.index')
            ->with('success', 'Usuario registrado correctamente.');
    }
    // Actualizar datos de un usuario
    public function update(Request $request, User $usuario)
    {
        $datos = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($usuario->id),
            ],
            'rol' => 'required|in:administrador,usuario',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        // Evitar quitarse a sí mismo el rol de administrador
        if ($usuario->id === auth()->id()
            && $datos['rol'] !== 'administrador') {
            return back()->withErrors([
                'rol' => 'No puedes quitarte tu propio rol de administrador.',
            ]);
        }
        $usuario->name = $datos['name'];
        $usuario->email = $datos['email'];
        $usuario->rol = $datos['rol'];
        if (!empty($datos['password'])) {
            $usuario->password = $datos['password'];
        }
        $usuario->save();

        return redirect()
            ->route('administracion.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }
    // Activar o desactivar un usuario
    public function cambiarEstado(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->withErrors([
                'usuario' => 'No puedes desactivar tu propia cuenta.',
            ]);
        }
        $usuario->activo = !$usuario->activo;
        $usuario->save();
        return redirect()
            ->route('administracion.index')
            ->with('success', 'Estado del usuario actualizado correctamente.');
    }
    // Eliminar un usuario
    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->withErrors([
                'usuario' => 'No puedes eliminar tu propia cuenta.',
            ]);
        }
        $usuario->delete();
        return redirect()
            ->route('administracion.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
