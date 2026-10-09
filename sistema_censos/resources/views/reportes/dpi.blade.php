
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fotografías del DPI - Municipalidad de Jalpatagua</title>
<style>
*{box-sizing:border-box}
body{font-family:Arial,sans-serif;background:#f4f6f9;color:#243247;margin:0}
.contenedor{max-width:1100px;margin:35px auto;padding:0 20px}
.encabezado{display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap}
h1{font-size:25px;color:#12335b}
p{color:#64748b}
.volver{background:#12335b;color:#fff;text-decoration:none;padding:12px 17px;border-radius:7px}
.grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px;margin-top:25px}
.tarjeta{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;box-shadow:0 2px 8px #00000008}
h2{font-size:16px;color:#12335b;margin:0 0 12px}
.foto{display:flex;align-items:center;justify-content:center;min-height:240px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden}
.foto img{display:block;width:100%;height:auto;max-height:400px;object-fit:contain}
.vacio{color:#64748b;text-align:center;padding:30px}
.botones{display:flex;gap:12px;flex-wrap:wrap;margin:20px 0}
.boton-pdf{color:white;padding:12px 18px;border-radius:7px;text-decoration:none;font-weight:bold}
.esposo{background:#198754}
.esposa{background:#0d6efd}
@media(max-width:700px){.grid{grid-template-columns:1fr}.contenedor{margin:20px auto}}
</style>
</head>
<body>
<main class="contenedor">
<div class="encabezado">
<div>
<h1>Fotografías del DPI</h1>
<p>Familia censada - Registro interno No. {{ $censo->id }}</p>
</div>
<a class="volver" href="{{ route('reportes.index') }}">Volver a reportes</a>
</div>
<div class="botones">
<a href="{{ route('reportes.dpi.descargar', ['id' => $censo->id, 'persona' => 'esposo']) }}" class="boton-pdf esposo">Descargar PDF del esposo</a>
<a href="{{ route('reportes.dpi.descargar', ['id' => $censo->id, 'persona' => 'esposa']) }}" class="boton-pdf esposa">Descargar PDF de la esposa</a>
</div>
<div class="grid">
@foreach($campos as $campo => $titulo)
<section class="tarjeta">
<h2>{{ $titulo }}</h2>
<div class="foto">
@if($imagenes[$campo] ?? false)
<img src="{{ route('reportes.dpi.imagen', ['id' => $censo->id, 'campo' => $campo]) }}" alt="{{ $titulo }}" loading="lazy">
@else
<p class="vacio">Fotografía no registrada</p>
@endif
</div>
</section>
@endforeach
</div>
</main>
</body>
</html>
