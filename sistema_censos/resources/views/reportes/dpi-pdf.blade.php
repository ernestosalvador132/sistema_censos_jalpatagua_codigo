<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>DPI {{ ucfirst($persona) }}</title>
<style>
@page { size: letter portrait; margin: 0; }
body { margin: 0; padding: 0; }
.contenedor { padding-top: 180px; width: 100%; }
.bloque { margin-bottom: 45px; page-break-inside: avoid; text-align: center; }
.foto { text-align: center; }
.foto img { display: block; margin: 0 auto; max-width: 85%; max-height: 250px; width: auto; height: auto; }
</style>
</head>
<body>
<div class="contenedor">
<div class="bloque">
<div class="foto"><img src="{{ $imagenes['frente'] }}" alt="DPI frente"></div>
</div>
<div class="bloque">
<div class="foto"><img src="{{ $imagenes['reverso'] }}" alt="DPI reverso"></div>
</div>
</div>
</body>
</html>
