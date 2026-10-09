<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte censal</title>
<style>
@page { margin: 25px 30px; }
body { font-family: DejaVu Sans, sans-serif; font-size: 9px; color: #243247; }
h1 { color: #12335b; font-size: 17px; margin-bottom: 8px; }
h2 { color: #12335b; font-size: 13px; margin: 16px 0 8px; border-bottom: 1px solid #cbd5e1; padding-bottom: 5px; }
h3 { background: #e9eff6; color: #12335b; font-size: 10px; padding: 7px; margin: 13px 0 5px; }
p { margin: 5px 0; }
table { width: 100%; border-collapse: collapse; margin-bottom: 8px; table-layout: fixed; }
tr { page-break-inside: avoid; }
th, td { border: 1px solid #cbd5e1; padding: 6px 7px; vertical-align: top; word-wrap: break-word; }
th { background: #f1f5f9; text-align: left; width: 43%; }
.registro { page-break-after: always; }
.registro:last-of-type { page-break-after: auto; }
.sin-datos { color: #64748b; font-style: italic; }
</style>
</head>
<body>
<h1>Municipalidad de Jalpatagua — Reporte censal</h1>
@php
$nombresCensistas = \Illuminate\Support\Facades\DB::table('users')->pluck('name', 'id');
$nombresReporte = ['general' => 'Reporte general', 'comunidad' => 'Reporte por comunidad', 'vivienda' => 'Reporte por características de vivienda', 'poblacion' => 'Reporte por población', 'educacion' => 'Reporte por educación', 'agricultura' => 'Reporte por actividad agrícola', 'discapacidad' => 'Reporte por discapacidad', 'desnutricion' => 'Reporte por desnutrición infantil'];
@endphp
<p><strong>Tipo de reporte:</strong> {{ $nombresReporte[$tipoReporte ?? 'general'] ?? 'Reporte general' }}
@if($tipoReporte === 'comunidad' && !empty($comunidad))
| <strong>Comunidad:</strong> {{ $comunidad }}
@endif
</p>
<p><strong>Total de familias censadas:</strong> {{ $censos->count() }}</p>
@forelse($censos as $censo)
@php
$numeroFamilia = $loop->iteration;
$datos = json_decode($censo->datos ?? '{}', true);
$datos = is_array($datos) ? $datos : [];
$datos = array_merge($datos, (array) $censo);
$hijos = $hijosPorCenso[$censo->id] ?? collect();
$camposDpi = ['dpi_frente_esposo', 'dpi_reverso_esposo', 'dpi_frente_esposa', 'dpi_reverso_esposa'];
@endphp
<div class="registro">
<h2>Familia censada No. {{ $numeroFamilia }}</h2>
@foreach($secciones as $seccion)
<h3>{{ $seccion['titulo'] }}</h3>
<table>
<tbody>
@foreach($seccion['campos'] as $clave => $etiqueta)
@php
$valor = $datos[$clave] ?? null;
if (in_array($clave, $camposDpi, true)) {
    $valor = is_string($valor) && trim($valor) !== '' ? 'Fotografía registrada' : 'No registrada';
} elseif (is_array($valor)) {
    $valor = json_encode($valor, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} elseif (is_bool($valor)) {
    $valor = $valor ? 'Sí' : 'No';
}
@endphp
<tr>
<th>{{ $etiqueta }}</th>
<td>{{ $valor !== null && $valor !== '' ? $valor : '—' }}</td>
</tr>
@if($seccion['titulo'] === 'Datos del censo' && $clave === 'fecha_censo')
<tr><th>Censo realizado por</th><td>{{ $nombresCensistas[$censo->user_id] ?? 'No registrado' }}</td></tr>
@endif
@endforeach
</tbody>
</table>
@if($seccion['titulo'] === 'Información de los hijos')
@forelse($hijos as $hijo)
<h3>Hijo {{ $loop->iteration }}</h3>
<table>
<tbody>
@foreach($camposHijos as $clave => $etiqueta)
@php
$valorHijo = $hijo->{$clave} ?? null;
if ($clave === 'edad' && !empty($hijo->fecha_nacimiento)) {
    try {
        $fechaNacimiento = \Carbon\Carbon::parse($hijo->fecha_nacimiento);
        $fechaReferencia = !empty($censo->fecha_censo) ? \Carbon\Carbon::parse($censo->fecha_censo) : \Carbon\Carbon::today();
        $valorHijo = $fechaNacimiento->lte($fechaReferencia) ? (int) $fechaNacimiento->diffInYears($fechaReferencia) : null;
    } catch (\Exception $e) {
        // Se conserva el valor registrado si no puede calcularse la edad.
    }
}
if (is_array($valorHijo)) {
    $valorHijo = json_encode($valorHijo, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} elseif (is_bool($valorHijo)) {
    $valorHijo = $valorHijo ? 'Sí' : 'No';
}
@endphp
<tr>
<th>{{ $etiqueta }}</th>
<td>{{ $valorHijo !== null && $valorHijo !== '' ? $valorHijo : '—' }}</td>
</tr>
@endforeach
</tbody>
</table>
@empty
<p class="sin-datos">No hay hijos registrados en esta familia.</p>
@endforelse
@endif
@endforeach
</div>
@empty
<p>No hay registros para los filtros seleccionados.</p>
@endforelse
</body>
</html>
