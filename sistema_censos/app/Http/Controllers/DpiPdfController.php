<?php
namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class DpiPdfController extends Controller
{
    public function descargar(int $id, string $persona)
    {
        abort_unless(in_array($persona, ['esposo', 'esposa'], true), 404);
        $censo = DB::table('censos')->where('id', $id)->first();
        abort_if(!$censo, 404);
        $datos = json_decode($censo->datos ?? '{}', true);
        $datos = is_array($datos) ? $datos : [];
        $disco = Storage::disk('local');
        $imagenes = [];
        foreach (['frente', 'reverso'] as $lado) {
            $campo = "dpi_{$lado}_{$persona}";
            $ruta = $datos[$campo] ?? null;
            abort_unless(is_string($ruta) && str_starts_with($ruta, 'censos/dpi/') && !str_contains($ruta, '..') && $disco->exists($ruta), 404, "No se encontró la fotografía del {$lado}.");
            $archivo = $disco->path($ruta);
            abort_unless(is_file($archivo) && is_readable($archivo), 404);
            $mime = mime_content_type($archivo);
            abort_unless(in_array($mime, ['image/jpeg', 'image/png'], true), 422, 'El PDF admite fotografías JPG o PNG.');
            $imagenes[$lado] = 'data:'.$mime.';base64,'.base64_encode(file_get_contents($archivo));
        }
        $pdf = Pdf::loadView('reportes.dpi-pdf', compact('censo', 'persona', 'imagenes'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->download("dpi_{$persona}_censo_{$id}.pdf");
    }
}
