<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class DpiController extends Controller
{
    private function campos(): array
    {
        return [
            'dpi_frente_esposo' => 'DPI del esposo - Frente',
            'dpi_reverso_esposo' => 'DPI del esposo - Reverso',
            'dpi_frente_esposa' => 'DPI de la esposa - Frente',
            'dpi_reverso_esposa' => 'DPI de la esposa - Reverso',
        ];
    }
    private function obtenerCenso(int $id): array
    {
        $censo = DB::table('censos')->where('id', $id)->first();
        abort_if(!$censo, 404);
        $datos = json_decode($censo->datos ?? '{}', true);
        return [$censo, is_array($datos) ? $datos : []];
    }
    public function index(int $id)
    {
        [$censo, $datos] = $this->obtenerCenso($id);
        $campos = $this->campos();
        $imagenes = [];
        foreach ($campos as $campo => $titulo) {
            $ruta = $datos[$campo] ?? null;
            $imagenes[$campo] = is_string($ruta)
                && str_starts_with($ruta, 'censos/dpi/')
                && !str_contains($ruta, '..')
                && Storage::disk('local')->exists($ruta);
        }
        return view('reportes.dpi', compact('censo', 'campos', 'imagenes'));
    }
    public function imagen(int $id, string $campo)
    {
        abort_unless(array_key_exists($campo, $this->campos()), 404);
        [$censo, $datos] = $this->obtenerCenso($id);
        $ruta = $datos[$campo] ?? null;
        abort_unless(is_string($ruta)
            && str_starts_with($ruta, 'censos/dpi/')
            && !str_contains($ruta, '..'), 404);
        $disco = Storage::disk('local');
        abort_unless($disco->exists($ruta), 404);
        $archivo = $disco->path($ruta);
        abort_unless(is_file($archivo) && is_readable($archivo), 404);
        $mime = mime_content_type($archivo);
        abort_unless(in_array($mime, ['image/jpeg', 'image/png', 'image/webp'], true), 404);
        return response()->file($archivo, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline',
            'Cache-Control' => 'private, no-store, max-age=0',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
