<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registro censal | Aplicación Web Censal</title>


<style>

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    color: #1f2937;
}

.contenedor {
    display: flex;
    min-height: 100vh;
}

/* MENÚ LATERAL */

.sidebar {
    width: 250px;
    background: #12335b;
    color: white;
    padding: 25px 18px;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
}

.logo {
    text-align: center;
    margin-bottom: 30px;
}

.logo img {
    width: 95px;
    height: 95px;
    object-fit: contain;
    background: white;
    border-radius: 50%;
    padding: 4px;
}

.logo h2 {
    font-size: 17px;
    margin-top: 12px;
}

.logo p {
    font-size: 12px;
    margin-top: 5px;
    color: #dbeafe;
}

.menu {
    display: flex;
    flex-direction: column;
}

.menu a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 14px 15px;
    margin-bottom: 7px;
    border-radius: 7px;
    font-size: 15px;
}

.menu a:hover,
.menu a.activo {
    background: #244d7c;
}

/* CONTENIDO PRINCIPAL */

.principal {
    margin-left: 250px;
    width: calc(100% - 250px);
    min-height: 100vh;
}

.barra-superior {
    height: 72px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 35px;
    border-bottom: 1px solid #e5e7eb;
}

.barra-superior h1 {
    font-size: 22px;
    color: #12335b;
}

.usuario {
    text-align: right;
}

.usuario strong {
    display: block;
    font-size: 14px;
}

.usuario span {
    display: block;
    font-size: 12px;
    color: #6b7280;
    margin-top: 2px;
}

/* CERRAR SESIÓN */
.usuario form { margin: 0; }
.cerrar-sesion {
    background: transparent;
    border: none;
    color: #dc2626;
    font-size: 12px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 4px;
    padding: 0;
}
.cerrar-sesion:hover { text-decoration: underline; }
@media (max-width: 800px) {
    .cerrar-sesion { font-size: 11px; }
}

.contenido {
    padding: 30px 35px;
}

.encabezado {
    margin-bottom: 25px;
}

.encabezado h2 {
    color: #12335b;
    font-size: 25px;
    margin-bottom: 6px;
}

.encabezado p {
    color: #6b7280;
    font-size: 14px;
}

/* FORMULARIO */

.formulario {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 28px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.seccion {
    margin-bottom: 28px;
}

.seccion h3 {
    color: #12335b;
    font-size: 18px;
    padding-bottom: 12px;
    margin-bottom: 18px;
    border-bottom: 1px solid #e5e7eb;
}

.campos {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px 20px;
}

.campos-tres {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px 20px;
}

.campo {
    display: flex;
    flex-direction: column;
}

.campo-completo {
    grid-column: 1 / -1;
}

.campo label {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 8px;
    color: #111827;
}

.campo input,
.campo select,
.campo textarea {
    width: 100%;
    height: 42px;
    border: 1px solid #cbd5e1;
    border-radius: 7px;
    padding: 0 14px;
    font-size: 14px;
    background: white;
    outline: none;
}

.campo textarea {
    height: 90px;
    padding-top: 12px;
    resize: vertical;
}

.campo input:focus,
.campo select:focus,
.campo textarea:focus {
    border-color: #244d7c;
}

.campo select:disabled {
    background: #f1f5f9;
    color: #94a3b8;
    cursor: not-allowed;
}

/* BOTONES */

.botones {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 15px;
}

.btn-limpiar,
.btn-guardar {
    border: none;
    border-radius: 7px;
    padding: 12px 22px;
    font-size: 14px;
    cursor: pointer;
}

.btn-limpiar {
    background: #e5e7eb;
    color: #374151;
}

.btn-guardar {
    background: #12335b;
    color: white;
}

.btn-limpiar:hover {
    background: #d1d5db;
}

.btn-guardar:hover {
    background: #244d7c;
}

@media (max-width: 1100px) {

    .campos-tres {
        grid-template-columns: repeat(2, 1fr);
    }

}

@media (max-width: 800px) {

    .sidebar {
        width: 210px;
    }

    .principal {
        margin-left: 210px;
        width: calc(100% - 210px);
    }

    .campos,
    .campos-tres {
        grid-template-columns: 1fr;
    }

}


/* Ajustes de distribución y alineación */
.seccion h4 { margin: 24px 0 16px; color: #12335b; font-size: 16px; }
.seccion .campos + .campos { margin-top: 18px; }
.campos > .campo, .campos-tres > .campo { min-width: 0; }
.campo input[type="file"] { height: auto; min-height: 42px; padding: 9px; }
.campo small { display: block; margin-top: 5px; font-size: 12px; }
@media (max-width: 800px) { .campos, .campos-tres { grid-template-columns: 1fr; } }

/* =========================================
   ADAPTACIÓN PARA TELÉFONOS Y TABLETAS
   No modifica la presentación de escritorio
========================================= */
.boton-menu-movil, .fondo-menu-movil { display: none; }
@media (max-width: 800px) {
    html, body { width: 100%; max-width: 100%; overflow-x: hidden; }
    .contenedor { display: block; width: 100%; min-width: 0; }
    .sidebar {
        width: min(285px, 85vw);
        max-width: 85vw;
        height: 100dvh;
        overflow-y: auto;
        position: fixed;
        top: 0; left: 0; bottom: 0;
        z-index: 1100;
        transform: translateX(-105%);
        transition: transform .25s ease;
        box-shadow: 4px 0 20px rgba(0,0,0,.16);
    }
    body.menu-movil-abierto .sidebar { transform: translateX(0); }
    .fondo-menu-movil {
        display: block;
        position: fixed;
        inset: 0;
        background: rgba(15,23,42,.52);
        z-index: 1090;
        opacity: 0;
        visibility: hidden;
        transition: opacity .25s, visibility .25s;
    }
    body.menu-movil-abierto .fondo-menu-movil { opacity: 1; visibility: visible; }
    body.menu-movil-abierto { overflow: hidden; }
    .principal { margin-left: 0; width: 100%; min-width: 0; }
    .barra-superior {
        height: auto;
        min-height: 66px;
        padding: 12px 16px;
        gap: 12px;
    }
    .encabezado-barra { display: flex; align-items: center; gap: 10px; min-width: 0; }
    .barra-superior h1 { font-size: 18px; line-height: 1.2; }
    .boton-menu-movil {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        flex: 0 0 42px;
        width: 42px; height: 42px;
        border: 1px solid #dbe3ed;
        border-radius: 8px;
        background: white;
        color: #12335b;
        font-size: 23px;
        cursor: pointer;
    }
    .usuario { min-width: 0; max-width: 38%; }
    .usuario strong, .usuario span { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .usuario strong { font-size: 12px; }
    .usuario span { font-size: 11px; }
    .contenido { padding: 20px 14px; min-width: 0; }
    .encabezado { margin-bottom: 18px; }
    .encabezado h2 { font-size: 21px; }
    .encabezado p { font-size: 13px; line-height: 1.5; }
    .formulario { padding: 18px 14px; width: 100%; min-width: 0; }
    .seccion { min-width: 0; margin-bottom: 24px; }
    .seccion h3 { font-size: 17px; line-height: 1.4; overflow-wrap: anywhere; }
    .campos, .campos-tres { grid-template-columns: minmax(0,1fr); gap: 16px; }
    .campo, .campo-completo { min-width: 0; max-width: 100%; }
    .campo label { line-height: 1.35; overflow-wrap: anywhere; }
    .campo input, .campo select, .campo textarea {
        display: block;
        width: 100%; max-width: 100%; min-width: 0;
        font-size: 16px;
    }
    .campo input[type="file"] { font-size: 14px; overflow-wrap: anywhere; }
    .campo input[type="date"] { min-width: 0; }
    .bloque-hijo { max-width: 100%; min-width: 0; }
    .botones { flex-direction: column; align-items: stretch; gap: 10px; }
    .btn-limpiar, .btn-guardar { width: 100%; min-height: 46px; }
}
@media (max-width: 380px) {
    .barra-superior { padding: 10px; gap: 7px; }
    .barra-superior h1 { font-size: 16px; }
    .contenido { padding: 14px 9px; }
    .formulario { padding: 15px 11px; }
    .usuario { max-width: 35%; }
}

</style>

</head>

<body>

<div class="contenedor">

<aside class="sidebar" id="menu-lateral" aria-label="Menú principal">

<div class="logo">

<img
src="{{ asset('images/logo-municipalidad.png') }}"
alt="Municipalidad de Jalpatagua"
>

<h2>Aplicación Web Censal</h2>

<p>Municipalidad de Jalpatagua</p>

</div>

<nav class="menu">
    <a href="{{ route('inicio') }}">Inicio</a>
    <a href="{{ route('censos.index') }}" class="activo" aria-current="page">Registro censal</a>
    @can('administrar-sistema')
    <a href="{{ route('reportes.index') }}">Reportes</a>
    @endcan
    <a href="{{ route('informacion.index') }}">Información</a>
    @can('administrar-sistema')
    <a href="{{ route('administracion.index') }}">Administración</a>
    @endcan
</nav>

</aside>

<div class="fondo-menu-movil" id="fondo-menu-movil" aria-hidden="true"></div>


<main class="principal">

<header class="barra-superior">

<div class="encabezado-barra">
    <button type="button" class="boton-menu-movil" id="boton-menu-movil"
            aria-label="Abrir menú" aria-expanded="false" aria-controls="menu-lateral">☰</button>
    <h1>{{ isset($censo) ? 'Editar censo' : 'Registro censal' }}</h1>
</div>

<div class="usuario">

<strong>
{{ Auth::user()->name }}
</strong>

<span>
{{ Auth::user()->can('administrar-sistema') ? 'Administrador' : 'Usuario' }}
</span>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="cerrar-sesion">Cerrar sesión</button>
</form>

</div>

</header>


<div class="contenido">

<div class="encabezado">

<h2>{{ isset($censo) ? 'Editar registro censal No. '.$censo->id : 'Nuevo registro censal' }}</h2>

<p>
Ingrese la información correspondiente a la vivienda
y los datos solicitados para el censo.
</p>

</div>


@if(session('success'))
<div role="status" style="background:#ecfdf5;color:#065f46;padding:14px;border:1px solid #a7f3d0;border-radius:8px;margin-bottom:18px;">{{ session('success') }}</div>
@endif
@if($errors->any())
<div role="alert" style="background:#fef2f2;color:#991b1b;padding:14px;border:1px solid #fecaca;border-radius:8px;margin-bottom:18px;">
<strong>No se pudo guardar el censo:</strong>
<ul style="margin:8px 0 0 20px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif
<form class="formulario" method="POST" action="{{ isset($censo) ? route('censos.update', $censo->id) : route('censos.store') }}" enctype="multipart/form-data">
@csrf
@if(isset($censo))
@method('PUT')
@endif
<section class="seccion">
<h3>Identificación Cartográfica</h3>
<div class="campos-tres">
<div class="campo">

<label for="departamento">
Departamento
</label>

<select
id="departamento"
name="departamento"
required
onchange="cargarMunicipio()"
>

<option value="">
Seleccione un departamento
</option>

<option value="Jutiapa">
Jutiapa
</option>

</select>
</div>
<div class="campo">

<label for="municipio">
Municipio
</label>

<select
id="municipio"
name="municipio"
required
disabled
onchange="cargarComunidades()"
>

<option value="">
Seleccione un municipio
</option>

</select>
</div>
<div class="campo">

<label for="comunidad">
Comunidad
</label>

<select
    id="comunidad"
    name="comunidad"
    required
    disabled
    onchange="habilitarDireccion()"
>

<option value="">
Seleccione una comunidad
</option>

</select>
</div>
<div class="campo">
    <label for="direccion">Dirección</label>

    <input
        type="text"
        id="direccion"
        name="direccion"
        placeholder="Seleccione primero una comunidad"
        disabled
        required
    >
</div>
</div>
</section>
<section class="seccion">
<h3>Características de la vivienda y datos del hogar</h3>
<div class="campos">
<div class="campo">
        <label for="material_paredes">
            Material predominante en las paredes exteriores
        </label>

        <select
            id="material_paredes"
            name="material_paredes"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Ladrillo">Ladrillo</option>
            <option value="Block">Block</option>
            <option value="Concreto">Concreto</option>
            <option value="Adobe">Adobe</option>
            <option value="Madera">Madera</option>
            <option value="Lamina metalica">Lámina metálica</option>
            <option value="Bajareque">Bajareque</option>
            <option value="Lepa, caña o palo">Lepa, caña o palo</option>
            <option value="Otro">Otro</option>
        </select>
</div>
<div class="campo">
        <label for="material_piso">
            Material predominante en el piso
        </label>

        <select
            id="material_piso"
            name="material_piso"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Ceramico">Ceramico</option>
            <option value="Ladrillo de cemento">Ladrillo de cemento</option>
            <option value="Ladrillo de barro">Ladrillo de barro</option>
            <option value="Torta de cemento">Torta de cemento</option>
            <option value="Tierra">Tierra</option>
            <option value="Otro">Otro</option>
        </select>
</div>
<div class="campo">
        <label for="material_techo">
            Material predominante en el techo
        </label>

        <select
            id="material_techo"
            name="material_techo"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Concreto">Concreto</option>
            <option value="Lamina metalica">Lámina metálica</option>
            <option value="Asbesto cemento">Asbesto cemento</option>
            <option value="Teja">Teja</option>
            <option value="Paja, palma o similar">Paja, palma o similar</option>
            <option value="Otro">Otro</option>
        </select>
</div>
</div>
<h4>La vivienda está conectada a:</h4>
<div class="campos">
<div class="campo">
        <label for="red_agua">
            Red de distribución de agua
        </label>

        <select
            id="red_agua"
            name="red_agua"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="red_drenajes">
            Red de drenajes
        </label>

        <select
            id="red_drenajes"
            name="red_drenajes"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="red_energia_electrica">
            Red de distribución de energía eléctrica
        </label>

        <select
            id="red_energia_electrica"
            name="red_energia_electrica"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="red_telefonica">
            Red telefónica
        </label>

        <select
            id="red_telefonica"
            name="red_telefonica"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
</div>
<div class="campos">
<div class="campo">
        <label for="fuente_agua">
            ¿De dónde obtiene principalmente el agua para el consumo del hogar?
        </label>

        <select
            id="fuente_agua"
            name="fuente_agua"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Tuberia dentro de la vivienda">
                Tubería (red) dentro de la vivienda
            </option>
            <option value="Tuberia fuera de la vivienda">
                Tubería (red) fuera de la vivienda, pero dentro del terreno
            </option>
            <option value="Chorro publico">
                Chorro público
            </option>
            <option value="Pozo perforado publico o privado">
                Pozo perforado público o privado
            </option>
            <option value="Rio lago o manantial">
                Río, lago o manantial
            </option>
            <option value="Camion cisterna">
                Camión cisterna
            </option>
            <option value="Agua de lluvia">
                Agua de lluvia
            </option>
            <option value="Otro">
                Otro
            </option>
        </select>
</div>
<div class="campo">
        <label for="eliminacion_basura">
            ¿Cómo eliminan principalmente la basura en este hogar?
        </label>

        <select
            id="eliminacion_basura"
            name="eliminacion_basura"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Servicio Municipal">
                Servicio Municipal
            </option>
            <option value="Servicio Privado">
                Servicio Privado
            </option>
            <option value="La queman">
                La queman
            </option>
            <option value="La entierran">
                La entierran
            </option>
            <option value="La tiran en cualquier lugar">
                La tiran en cualquier lugar
            </option>
            <option value="Abonera, Reciclaje">
                Abonera, Reciclaje
            </option>
            <option value="Otro">
                Otro
            </option>
        </select>
</div>
<div class="campo">

        <label for="tipo_sanitario">
            ¿Qué tipo de sanitario tiene este hogar?
        </label>

        <select
            id="tipo_sanitario"
            name="tipo_sanitario"
            required
        >
            <option value="">Seleccione una opción</option>

            <option value="Inodoro conectado a red de drenajes">
                Inodoro conectado a red de drenajes
            </option>

            <option value="Inodoro conectado a fosa septica">
                Inodoro conectado a fosa séptica
            </option>

            <option value="Excusado lavable">
                Excusado lavable
            </option>

            <option value="Letrina o pozo ciego">
                Letrina o pozo ciego
            </option>

            <option value="No tiene">
                No tiene
            </option>

        </select>
</div>
<div class="campo">
<label for="uso_sanitario">
            El servicio sanitario es de:
        </label>

        <select
            id="uso_sanitario"
            name="uso_sanitario"
            required
        >
            <option value="">Seleccione una opción</option>

            <option value="Uso exclusivo del hogar">
                Uso exclusivo del hogar
            </option>

            <option value="Compartido con otros hogares">
                Compartido con otros hogares
            </option>
        <option value="N/A">
        N/A
    </option>
        </select>
</div>
<div class="campo">
        <label for="cantidad_cuartos">
            ¿De cuántos cuartos dispone este hogar?
        </label>

        <input
            type="number"
            id="cantidad_cuartos"
            name="cantidad_cuartos"
            min="0"
            step="1"
            placeholder="Ingrese la cantidad de cuartos"
            required
        >
</div>
<div class="campo">
        <label for="cuartos_dormitorio">
            ¿Cuántos cuartos utiliza como dormitorio?
        </label>

        <input
            type="number"
            id="cuartos_dormitorio"
            name="cuartos_dormitorio"
            min="0"
            step="1"
            placeholder="Ingrese la cantidad de dormitorios"
            required
        >
</div>
</div>
<h4>El hogar cuenta con:</h4>
<div class="campos">
<div class="campo">
        <label for="television">Televisión</label>
        <select id="television" name="television" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="radio">Radio</label>
        <select id="radio" name="radio" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="grabadora">Grabadora o radio grabadora</label>
        <select id="grabadora" name="grabadora" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="piedra_moler">Piedra de moler</label>
        <select id="piedra_moler" name="piedra_moler" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="molino_nixtamal">Molino manual de Nixtamal</label>
        <select id="molino_nixtamal" name="molino_nixtamal" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="estufa_gas">Estufa a gas</label>
        <select id="estufa_gas" name="estufa_gas" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="refrigeradora">Refrigeradora</label>
        <select id="refrigeradora" name="refrigeradora" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="plancha_brasas">Plancha de brasas</label>
        <select id="plancha_brasas" name="plancha_brasas" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="plancha_electrica">Plancha eléctrica</label>
        <select id="plancha_electrica" name="plancha_electrica" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="lavadora">Lavadora de ropa</label>
        <select id="lavadora" name="lavadora" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="bicicleta">Bicicleta</label>
        <select id="bicicleta" name="bicicleta" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
<div class="campo">
        <label for="automovil">Automóvil</label>
        <select id="automovil" name="automovil" required>
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
</div>
<div class="campos">
<div class="campo">
        <label for="tenencia_vivienda">
            La vivienda que ocupa este hogar es:
        </label>

        <select
            id="tenencia_vivienda"
            name="tenencia_vivienda"
            required
        >
            <option value="">Seleccione una opción</option>

            <option value="Propia y totalmente pagada">
                Propia y totalmente pagada
            </option>

            <option value="Propia y pagandose a plazos">
                Propia y pagándose a plazos
            </option>

            <option value="Alquilada">
                Alquilada
            </option>

            <option value="Cedida o prestada">
                Cedida o prestada
            </option>

            <option value="Otra forma">
                Otra forma
            </option>

        </select>
</div>
<div class="campo">
        <label for="medio_obtencion_vivienda">
            ¿Por cuál medio, el hogar obtuvo esta vivienda?
        </label>

        <select
            id="medio_obtencion_vivienda"
            name="medio_obtencion_vivienda"
            required
        >
            <option value="">Seleccione una opción</option>

            <option value="Recursos propios">
                Recursos propios
            </option>

            <option value="Instituciones financieras publicas">
                Instituciones financieras públicas
            </option>

            <option value="Instituciones financieras privadas">
                Instituciones financieras privadas
            </option>

            <option value="Herencia">
                Herencia
            </option>

            <option value="Regalada">
                Regalada
            </option>
            <option value="N/A">
            N/A
            </option>
        </select>
</div>
<div class="campo">
        <label for="programa_vivienda">
            ¿A través de qué programa accedió a esta vivienda?
        </label>

        <select
            id="programa_vivienda"
            name="programa_vivienda"
            required
        >
            <option value="">Seleccione una opción</option>

            <option value="FOGUAVI">
                FOGUAVI
            </option>

            <option value="Techo Minimo">
                Techo Mínimo
            </option>

            <option value="Programa Nacional de Resarcimiento">
                Programa Nacional de Resarcimiento
            </option>

            <option value="Municipalidad">
                Municipalidad
            </option>

            <option value="Secretaria de Coordinacion Ejecutiva de la Presidencia">
                Secretaría de Coordinación Ejecutiva de la Presidencia
            </option>

            <option value="FONAPAZ">
                FONAPAZ
            </option>

            <option value="Otra">
                Otra
            </option>
        <option value="N/A">
        N/A
        </option>

        </select>
</div>
<div class="campo">
        <label for="vivienda_institucion">
            ¿La vivienda que ocupa este hogar fue construida o financiada por alguna institución pública y/o ONG?
        </label>

        <select
            id="vivienda_institucion"
            name="vivienda_institucion"
            required
        >
            <option value="">Seleccione una opción</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
        </select>
</div>
</div>
</section>
<section class="seccion">
<h3>Información del esposo</h3>
<div class="campos-tres">
<div class="campo">

<label for="primer_nombre_esposo">
Primer nombre
</label>

<input
type="text"
id="primer_nombre_esposo"
name="primer_nombre_esposo"
placeholder="Ingrese el primer nombre"
oninput="this.value = this.value.replace(/[0-9]/g, '')"
>
</div>
<div class="campo">

<label for="segundo_nombre_esposo">
Segundo nombre
</label>

<input
type="text"
id="segundo_nombre_esposo"
name="segundo_nombre_esposo"
placeholder="Ingrese el segundo nombre"
oninput="this.value = this.value.replace(/[0-9]/g, '')"
>
</div>
<div class="campo">

<label for="tercer_nombre_esposo">
Tercer nombre
</label>

<input
type="text"
id="tercer_nombre_esposo"
name="tercer_nombre_esposo"
placeholder="Ingrese el tercer nombre"
oninput="this.value = this.value.replace(/[0-9]/g, '')"
>
</div>
<div class="campo">

<label for="primer_apellido_esposo">
Primer apellido
</label>

<input
type="text"
id="primer_apellido_esposo"
name="primer_apellido_esposo"
placeholder="Ingrese el primer apellido"
oninput="this.value = this.value.replace(/[0-9]/g, '')"
>
</div>
<div class="campo">

<label for="segundo_apellido_esposo">
Segundo apellido
</label>

<input
type="text"
id="segundo_apellido_esposo"
name="segundo_apellido_esposo"
placeholder="Ingrese el segundo apellido"
oninput="this.value = this.value.replace(/[0-9]/g, '')"
>
</div>
<div class="campo">


<label for="cui_esposo">No. de CUI</label>
<input
    type="text"
    id="cui_esposo"
    name="cui_esposo"
    inputmode="numeric"
    maxlength="13"
    minlength="13"
    pattern="[0-9]{13}"
    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13)"
    placeholder="Ingrese los 13 dígitos del CUI"
>
</div>
<div class="campo">

    <label for="grupo_etnico_esposo">
        Grupo étnico
    </label>

    <select
        id="grupo_etnico_esposo"
        name="grupo_etnico_esposo"
    >
        <option value="">Seleccione un grupo étnico</option>
        <option value="K'iche'">K'iche'</option>
        <option value="Q'eqchi'">Q'eqchi'</option>
        <option value="Mam">Mam</option>
        <option value="Kaqchikel">Kaqchikel</option>
        <option value="Q'anjob'al">Q'anjob'al</option>
        <option value="Achi">Achi</option>
        <option value="Ixil">Ixil</option>
        <option value="Itza'">Itza'</option>
        <option value="Poqomchi'">Poqomchi'</option>
        <option value="Chuj">Chuj</option>
        <option value="Awakateko">Awakateko</option>
        <option value="Poqomam">Poqomam</option>
        <option value="Ch'orti'">Ch'orti'</option>
        <option value="Jakalteko">Jakalteko</option>
        <option value="Sakapulteco">Sakapulteco</option>
        <option value="Mopan">Mopan</option>
        <option value="Uspanteko">Uspanteko</option>
        <option value="Tz'utujil">Tz'utujil</option>
        <option value="Tektiteko">Tektiteko</option>
        <option value="Sipakapense">Sipakapense</option>
        <option value="Chalchiteko">Chalchiteko</option>
        <option value="Akateko">Akateko</option>
        <option value="Xinka">Xinka</option>
        <option value="Garifuna">Garífuna</option>
        <option value="No indigena">No indígena</option>
        <option value="Extranjero">Extranjero</option>
    </select>
</div>
<div class="campo">
    <label for="fecha_nacimiento_esposo">Fecha de nacimiento</label>

    <input
        type="date"
        id="fecha_nacimiento_esposo"
        name="fecha_nacimiento_esposo"
        min="1900-01-01"
        max="{{ date('Y-m-d') }}"
        onchange="calcularEdadEsposo()"
    >
</div>
<div class="campo">
    <label for="edad_esposo">Edad</label>
    <input
        type="number"
        id="edad_esposo"
        name="edad_esposo"
        placeholder="Edad"
        readonly
    >
</div>
</div>
<div class="campos" style="margin-top: 20px;">
<div class="campo">
        <label for="estado_civil_esposo">Estado Civil</label>

        <select
            id="estado_civil_esposo"
            name="estado_civil_esposo"
        >
            <option value="">Seleccione una opción</option>
            <option value="Unido">Unido</option>
            <option value="Casado">Casado</option>
            <option value="Separado(a) de matrimonio">Separado(a) de matrimonio</option>
            <option value="Separado(a) de unión">Separado(a) de unión</option>
            <option value="Divorciado(a)">Divorciado(a)</option>
            <option value="Viudo(a)">Viudo(a)</option>
            <option value="Soltero(a)">Soltero(a)</option>
            <option value="Menor de 12 años">Menor de 12 años</option>
        </select>

</div>
<div class="campo">
        <label for="discapacidad_esposo">Discapacidad permanente</label>

        <select
            id="discapacidad_esposo"
            name="discapacidad_esposo"
        >
            <option value="">Seleccione una opción</option>
            <option value="Extremidades Superiores (Brazos, Manos, Dedos)">Extremidades Superiores(Brazos, Manos, Dedos)</option>
            <option value="Extremidades Posteriores (Pierna, Pie, Dedos)">Extremidades Posteriores (Pierna, Pie, Dedos)</option>
            <option value="Todo el cuerpo">Todo el cuerpo</option>
            <option value="Visual">Visual</option>
            <option value="Auditiva">Auditiva</option>
            <option value="Sordomudo">Sordomudo</option>
            <option value="Padece deficiencia mental">Padece deficiencia mental</option>
            <option value="Sin discapacidad">Sin discapacidad</option>
        </select>
</div>
<div class="campo">
    <label for="sabe_leer_escribir_esposo">
        ¿Sabe leer y escribir?
    </label>

    <select
        id="sabe_leer_escribir_esposo"
        name="sabe_leer_escribir_esposo"
    >
        <option value="">Seleccione una opción</option>
        <option value="Si">Sí</option>
        <option value="No">No</option>
    </select>
</div>
<div class="campo">
    <label for="ultimo_grado_aprobado_esposo">
        Último grado aprobado
    </label>

    <select
        id="ultimo_grado_aprobado_esposo"
        name="ultimo_grado_aprobado_esposo"
    >
        <option value="">Seleccione una opción</option>

        <option value="Ninguno">Ninguno</option>
        <option value="Preprimaria">Preprimaria</option>

        <option value="Primero primaria">Primero primaria</option>
        <option value="Segundo primaria">Segundo primaria</option>
        <option value="Tercero primaria">Tercero primaria</option>
        <option value="Cuarto primaria">Cuarto primaria</option>
        <option value="Quinto primaria">Quinto primaria</option>
        <option value="Sexto primaria">Sexto primaria</option>

        <option value="Primero basico">Primero básico</option>
        <option value="Segundo basico">Segundo básico</option>
        <option value="Tercero basico">Tercero básico</option>

        <option value="Primer año diversificado">Primer año diversificado</option>
        <option value="Segundo año diversificado">Segundo año diversificado</option>
        <option value="Tercer año diversificado">Tercer año diversificado</option>

        <option value="Primer año Superior">Primer año Superior</option>
        <option value="Segundo año Superior">Segundo año Superior</option>
        <option value="Tercer año Superior">Tercer año Superior</option>
        <option value="Cuarto año Superior">Cuarto año Superior</option>
        <option value="Quinto año Superior">Quinto año Superior</option>
        <option value="Sexto año Superior">Sexto año Superior</option>
        <option value="Septimo año Superior">Séptimo año Superior</option>

        <option value="Primer año PostGrado">Primer año PostGrado</option>
        <option value="Segundo año Postgrado">Segundo año Postgrado</option>
        <option value="Tercer año post grado">Tercer año post grado</option>

    </select>
</div>
<div class="campo">
    <label for="categoria_ocupacional_esposo">
        Categoría ocupacional
    </label>

    <select
        id="categoria_ocupacional_esposo"
        name="categoria_ocupacional_esposo"
    >
        <option value="">Seleccione una opción</option>

        <option value="Empleado(a) Publico">
            Empleado(a) Público
        </option>

        <option value="Empleado(a) privado(a)">
            Empleado(a) privado(a)
        </option>

        <option value="Trabajador(a) cuenta propia NO agricola">
            Trabajador(a) cuenta propia NO agrícola
        </option>

        <option value="Patron(a) empleador(a), socio(a) NO agricola">
            Patrón(a), empleador(a), socio(a) NO agrícola
        </option>

        <option value="Patron(a) empleador(a), socio(a) agricola">
            Patrón(a), empleador(a), socio(a) agrícola
        </option>

        <option value="Trabajador(a) por cuenta propia agricola">
            Trabajador(a) por cuenta propia agrícola
        </option>

<option value="Jubilado">
    Jubilado
</option>

<option value="Desempleado">
    Desempleado
</option>

<option value="N/A">
    N/A
</option>

    </select>
</div>
</div>
</section>
<!-- =========================================
     INFORMACIÓN AGRÍCOLA DEL ESPOSO
========================================== -->

<section class="seccion">

    <div class="campos">

        <!-- ¿SIEMBRA? -->
        <div class="campo">
            <label for="siembra_esposo">
                ¿Siembra?
            </label>

            <select
                id="siembra_esposo"
                name="siembra_esposo"
                onchange="habilitarCultivoEsposo()"
            >
                <option value="">Seleccione una opción</option>

                <option value="Si">
                    Sí
                </option>

                <option value="No">
                    No
                </option>
            </select>
        </div>

        <!-- ¿QUÉ CULTIVO SIEMBRA? -->
        <div class="campo">
            <label for="tipo_cultivo_esposo">
                ¿Qué cultivo siembra?
            </label>

            <select
                id="tipo_cultivo_esposo"
                name="tipo_cultivo_esposo"
                disabled
            >
                <option value="">Seleccione un cultivo</option>
                <option value="Maíz">
                    Maíz
                </option>
                <option value="Frijol">
                    Frijol
                </option>
                <option value="Sorgo">
                    Sorgo
                </option>
            </select>
        </div>

    </div>

    <!-- CANTIDAD QUE SIEMBRA -->
    <div class="campo" style="margin-top: 15px;">

        <label>
            ¿Qué cantidad siembra?
        </label>

        <div class="campos">

            <!-- CANTIDAD -->
            <div class="campo">
                <select
                    id="cantidad_siembra_esposo"
                    name="cantidad_siembra_esposo"
                    aria-label="Cantidad que siembra"
                    disabled
                >
                    <option value="">Seleccione cantidad</option>

                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- UNIDAD DE MEDIDA -->
            <div class="campo">
                <select
                    id="unidad_siembra_esposo"
                    name="unidad_siembra_esposo"
                    aria-label="Unidad de medida de siembra"
                    disabled
                >
                    <option value="">Seleccione unidad</option>

                    <option value="Manzanas">
                        Manzanas
                    </option>

                    <option value="Cuerdas">
                        Cuerdas
                    </option>

                    <option value="Tareas">
                        Tareas
                    </option>
                </select>
            </div>

        </div>

    </div>

</section>
<section class="seccion">
<!-- FOTOGRAFÍAS DEL DPI DEL ESPOSO -->

<h3 style="margin-top: 25px; margin-bottom: 20px;">
    Fotografía del DPI
</h3>

<div class="campos">

    <div class="campo">
        <label for="dpi_frente_esposo">
            Fotografía del DPI - Frente
        </label>
        <input
            type="file"
            id="dpi_frente_esposo"
            name="dpi_frente_esposo"
            accept="image/jpeg,image/png,image/webp"
        >
@if(!empty($datos['dpi_frente_esposo']))
<small style="color:#166534;">Fotografía guardada. Si no selecciona otra, se conservará la actual.</small>
@endif
    </div>

    <div class="campo">
        <label for="dpi_reverso_esposo">
            Fotografía del DPI - Reverso
        </label>
        <input
            type="file"
            id="dpi_reverso_esposo"
            name="dpi_reverso_esposo"
            accept="image/jpeg,image/png,image/webp"
        >
@if(!empty($datos['dpi_reverso_esposo']))
<small style="color:#166534;">Fotografía guardada. Si no selecciona otra, se conservará la actual.</small>
@endif
    </div>

</div>
</section>
<section class="seccion">
<h3>Información de la esposa</h3>
<div class="campos-tres">
<div class="campo">
            <label for="primer_nombre_esposa">Primer nombre</label>

            <input
                type="text"
                id="primer_nombre_esposa"
                name="primer_nombre_esposa"
                placeholder="Ingrese el primer nombre"
                oninput="this.value = this.value.replace(/[0-9]/g, '')"
            >
</div>
<div class="campo">
            <label for="segundo_nombre_esposa">Segundo nombre</label>

            <input
                type="text"
                id="segundo_nombre_esposa"
                name="segundo_nombre_esposa"
                placeholder="Ingrese el segundo nombre"
                oninput="this.value = this.value.replace(/[0-9]/g, '')"
            >
</div>
<div class="campo">
            <label for="tercer_nombre_esposa">Tercer nombre</label>

            <input
                type="text"
                id="tercer_nombre_esposa"
                name="tercer_nombre_esposa"
                placeholder="Ingrese el tercer nombre"
                oninput="this.value = this.value.replace(/[0-9]/g, '')"
            >
</div>
<div class="campo">
            <label for="primer_apellido_esposa">Primer apellido</label>

            <input
                type="text"
                id="primer_apellido_esposa"
                name="primer_apellido_esposa"
                placeholder="Ingrese el primer apellido"
                oninput="this.value = this.value.replace(/[0-9]/g, '')"
            >
</div>
<div class="campo">
            <label for="segundo_apellido_esposa">Segundo apellido</label>

            <input
                type="text"
                id="segundo_apellido_esposa"
                name="segundo_apellido_esposa"
                placeholder="Ingrese el segundo apellido"
                oninput="this.value = this.value.replace(/[0-9]/g, '')"
            >
</div>
<div class="campo">
            <label for="apellido_casada_esposa">Apellido de casada</label>

            <input
                type="text"
                id="apellido_casada_esposa"
                name="apellido_casada_esposa"
                placeholder="Ingrese el apellido de casada"
                oninput="this.value = this.value.replace(/[0-9]/g, '')"
            >
</div>
<div class="campo">
            <label for="cui_esposa">No. de CUI</label>

            <input
                type="text"
                id="cui_esposa"
                name="cui_esposa"
                inputmode="numeric"
                maxlength="13"
                minlength="13"
                pattern="[0-9]{13}"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13)"
                placeholder="Ingrese los 13 dígitos del CUI"
            >
</div>
<div class="campo">

    <label for="grupo_etnico_esposa">
        Grupo étnico
    </label>

    <select
        id="grupo_etnico_esposa"
        name="grupo_etnico_esposa"
    >
        <option value="">Seleccione un grupo étnico</option>
        <option value="Maya">Maya</option>
       <option value="K'iche'">K'iche'</option>
                <option value="Q'eqchi'">Q'eqchi'</option>
                <option value="Mam">Mam</option>
                <option value="Kaqchikel">Kaqchikel</option>
                <option value="Q'anjob'al">Q'anjob'al</option>
                <option value="Achi">Achi</option>
                <option value="Ixil">Ixil</option>
                <option value="Itza'">Itza'</option>
                <option value="Poqomchi'">Poqomchi'</option>
                <option value="Chuj">Chuj</option>
                <option value="Awakateko">Awakateko</option>
                <option value="Poqomam">Poqomam</option>
                <option value="Ch'orti'">Ch'orti'</option>
                <option value="Jakalteko">Jakalteko</option>
                <option value="Sakapulteco">Sakapulteco</option>
                <option value="Mopan">Mopan</option>
                <option value="Uspanteko">Uspanteko</option>
                <option value="Tz'utujil">Tz'utujil</option>
                <option value="Tektiteko">Tektiteko</option>
                <option value="Sipakapense">Sipakapense</option>
                <option value="Chalchiteko">Chalchiteko</option>
                <option value="Akateko">Akateko</option>
                <option value="Xinka">Xinka</option>
                <option value="Garifuna">Garífuna</option>
                <option value="No indigena">No indígena</option>
                <option value="Extranjero">Extranjero</option>
    </select>
</div>
<div class="campo">
          <label for="fecha_nacimiento_esposa">Fecha de nacimiento</label>
            <input
                type="date"
                id="fecha_nacimiento_esposa"
                name="fecha_nacimiento_esposa"
                min="1900-01-01"
                max="{{ date('Y-m-d') }}"
                onchange="calcularEdadEsposa()"
            >
</div>
<div class="campo">
            <label for="edad_esposa">Edad</label>
            <input
                type="number"
                id="edad_esposa"
                name="edad_esposa"
                placeholder="Edad"
                readonly
            >
</div>
</div>
<div class="campos">
<div class="campo">
        <label for="estado_conyugal_esposa">Estado Civil</label>

        <select
            id="estado_civil_esposa"
            name="estado_civil_esposa"
        >
            <option value="">Seleccione una opción</option>
            <option value="Unido">Unido</option>
            <option value="Casado">Casado</option>
            <option value="Separado(a) de matrimonio">Separado(a) de matrimonio</option>
            <option value="Separado(a) de unión">Separado(a) de unión</option>
            <option value="Divorciado(a)">Divorciado(a)</option>
            <option value="Viudo(a)">Viudo(a)</option>
            <option value="Soltero(a)">Soltero(a)</option>
            <option value="Menor de 12 años">Menor de 12 años</option>
        </select>

</div>
<div class="campo">
        <label for="discapacidad_esposa">Discapacidad permanente</label>

        <select
            id="discapacidad_esposa"
            name="discapacidad_esposa"
        >
            <option value="">Seleccione una opción</option>
            <option value="Extremidades Superiores (Brazos, Manos, Dedos)">Extremidades Superiores(Brazos, Manos, Dedos)</option>
            <option value="Extremidades Posteriores (Pierna, Pie, Dedos)">Extremidades Posteriores (Pierna, Pie, Dedos)</option>
            <option value="Todo el cuerpo">Todo el cuerpo</option>
            <option value="Visual">Visual</option>
            <option value="Auditiva">Auditiva</option>
            <option value="Sordomudo">Sordomudo</option>
            <option value="Padece deficiencia mental">Padece deficiencia mental</option>
            <option value="Sin discapacidad">Sin discapacidad</option>
        </select>
</div>
<div class="campo">
    <label for="sabe_leer_escribir_esposa">
        ¿Sabe leer y escribir?
    </label>

    <select
        id="sabe_leer_escribir_esposa"
        name="sabe_leer_escribir_esposa"
    >
        <option value="">Seleccione una opción</option>
        <option value="Si">Sí</option>
        <option value="No">No</option>
    </select>
</div>
<div class="campo">
    <label for="ultimo_grado_aprobado_esposa">
        Último grado aprobado
    </label>

    <select
        id="ultimo_grado_aprobado_esposa"
        name="ultimo_grado_aprobado_esposa"
    >
        <option value="">Seleccione una opción</option>

        <option value="Ninguno">Ninguno</option>
        <option value="Preprimaria">Preprimaria</option>

        <option value="Primero primaria">Primero primaria</option>
        <option value="Segundo primaria">Segundo primaria</option>
        <option value="Tercero primaria">Tercero primaria</option>
        <option value="Cuarto primaria">Cuarto primaria</option>
        <option value="Quinto primaria">Quinto primaria</option>
        <option value="Sexto primaria">Sexto primaria</option>

        <option value="Primero basico">Primero básico</option>
        <option value="Segundo basico">Segundo básico</option>
        <option value="Tercero basico">Tercero básico</option>

        <option value="Primer año diversificado">Primer año diversificado</option>
        <option value="Segundo año diversificado">Segundo año diversificado</option>
        <option value="Tercer año diversificado">Tercer año diversificado</option>

        <option value="Primer año Superior">Primer año Superior</option>
        <option value="Segundo año Superior">Segundo año Superior</option>
        <option value="Tercer año Superior">Tercer año Superior</option>
        <option value="Cuarto año Superior">Cuarto año Superior</option>
        <option value="Quinto año Superior">Quinto año Superior</option>
        <option value="Sexto año Superior">Sexto año Superior</option>
        <option value="Septimo año Superior">Séptimo año Superior</option>

        <option value="Primer año PostGrado">Primer año PostGrado</option>
        <option value="Segundo año Postgrado">Segundo año Postgrado</option>
        <option value="Tercer año post grado">Tercer año post grado</option>

    </select>
</div>
<div class="campo">
    <label for="categoria_ocupacional_esposa">
        Categoría ocupacional
    </label>

    <select
        id="categoria_ocupacional_esposa"
        name="categoria_ocupacional_esposa"
    >
        <option value="">Seleccione una opción</option>

        <option value="Empleado(a) Publico">
            Empleado(a) Público
        </option>

        <option value="Empleado(a) privado(a)">
            Empleado(a) privado(a)
        </option>

        <option value="Trabajador(a) cuenta propia NO agricola">
            Trabajador(a) cuenta propia NO agrícola
        </option>

        <option value="Patron(a) empleador(a), socio(a) NO agricola">
            Patrón(a), empleador(a), socio(a) NO agrícola
        </option>

        <option value="Patron(a) empleador(a), socio(a) agricola">
            Patrón(a), empleador(a), socio(a) agrícola
        </option>

        <option value="Trabajador(a) por cuenta propia agricola">
            Trabajador(a) por cuenta propia agrícola
        </option>

<option value="Jubilado">
    Jubilado
</option>

<option value="Desempleado">
    Desempleado
</option>

<option value="N/A">
    N/A
</option>

    </select>
</div>
</div>
</section>

<!-- =========================================
     INFORMACIÓN AGRÍCOLA
========================================== -->

<section class="seccion">

    <div class="campos">

        <!-- ¿SIEMBRA? -->
        <div class="campo">
            <label for="siembra">
                ¿Siembra?
            </label>

            <select
                id="siembra"
                name="siembra"
                onchange="habilitarCultivo()"
            >
                <option value="">Seleccione una opción</option>

                <option value="Si">
                    Sí
                </option>

                <option value="No">
                    No
                </option>
            </select>
        </div>

        <!-- ¿QUÉ CULTIVO SIEMBRA? -->
        <div class="campo">
            <label for="tipo_cultivo">
                ¿Qué cultivo siembra?
            </label>

            <select
                id="tipo_cultivo"
                name="tipo_cultivo"
                disabled
            >
                <option value="">Seleccione un cultivo</option>

                <option value="Maíz">
                    Maíz
                </option>

                <option value="Frijol">
                    Frijol
                </option>

                <option value="Sorgo">
                    Sorgo
                </option>
            </select>
        </div>

    </div>

    <!-- CANTIDAD QUE SIEMBRA -->
    <div class="campo" style="margin-top: 15px;">

        <label>
            ¿Qué cantidad siembra?
        </label>

        <div class="campos">

            <!-- CANTIDAD -->
            <div class="campo">
                <select
                    id="cantidad_siembra"
                    name="cantidad_siembra"
                    aria-label="Cantidad que siembra"
                    disabled
                >
                    <option value="">Seleccione cantidad</option>

                    @for ($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}">
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- UNIDAD DE MEDIDA -->
            <div class="campo">
                <select
                    id="unidad_siembra"
                    name="unidad_siembra"
                    aria-label="Unidad de medida de siembra"
                    disabled
                >
                    <option value="">Seleccione unidad</option>

                    <option value="Manzanas">
                        Manzanas
                    </option>

                    <option value="Cuerdas">
                        Cuerdas
                    </option>

                    <option value="Tareas">
                        Tareas
                    </option>
                </select>
            </div>

        </div>

    </div>

</section>

</section>

<section class="seccion">
<h3>Fotografías del DPI</h3>
<div class="campos">
<div class="campo">
        <label for="dpi_frente_esposa">
            Fotografía del DPI - Frente
        </label>

        <input
            type="file"
            id="dpi_frente_esposa"
            name="dpi_frente_esposa"
            accept="image/jpeg,image/png,image/webp"
        >
@if(!empty($datos['dpi_frente_esposa']))
    <small style="color:green;">
        Fotografía guardada. Si no selecciona otra, se conservará la actual.
    </small>
@endif
</div>
<div class="campo">
        <label for="dpi_reverso_esposa">
            Fotografía del DPI - Reverso
        </label>

        <input
            type="file"
            id="dpi_reverso_esposa"
            name="dpi_reverso_esposa"
            accept="image/jpeg,image/png,image/webp"
        >
@if(!empty($datos['dpi_reverso_esposa']))
<small style="color:#166534;">Fotografía guardada. Si no selecciona otra, se conservará la actual.</small>
@endif
</div>
</div>
</section>

<!-- =========================================
     INFORMACIÓN DE LOS HIJOS
========================================== -->

<section class="seccion">

    <h3>Información de los hijos</h3>

    <div class="campos">
        <div class="campo">
            <label for="tiene_hijos">¿Tiene hijos?</label>

            <select id="tiene_hijos"
                    name="tiene_hijos"
                    onchange="mostrarHijos()"
                    required>
                <option value="">Seleccione una opción</option>
                <option value="Si">Sí</option>
                <option value="No">No</option>
            </select>
        </div>
    </div>

    <div id="contenedor_hijos" style="display: none; margin-top: 20px;">

        <div id="lista_hijos"></div>

        <button type="button"
                onclick="agregarHijo()"
                style="margin-top: 15px; padding: 10px 18px; cursor: pointer;">
            + Agregar hijo
        </button>

    </div>


<!-- DATOS DEL CENSO -->
<section class="seccion">

    <h3>Datos del censo</h3>

    <div class="campos">

        <!-- COLUMNA IZQUIERDA -->
        <div>

            <!-- FECHA DEL CENSO -->
            <div class="campo">
                <label for="fecha_censo">
                    Fecha del censo
                </label>

                <input
                    type="date"
                    id="fecha_censo"
                    name="fecha_censo"
                    value="{{ old('fecha_censo', $datos['fecha_censo'] ?? date('Y-m-d')) }}"
                    required
                >
            </div>

            <!-- OBSERVACIONES -->
            <div class="campo" style="margin-top: 15px;">
                <label for="observaciones">
                    Observaciones
                </label>

                <textarea
                    id="observaciones"
                    name="observaciones"
                    placeholder="Ingrese observaciones adicionales"
                    rows="4"
                ></textarea>
            </div>

        </div>

        <!-- COLUMNA DERECHA -->
        <div>

            <!-- USUARIO QUE REALIZÓ EL CENSO -->
            <div class="campo">
                <label for="usuario_censista">
                    Censo realizado por
                </label>

                <input
                    type="text"
                    id="usuario_censista"
                    value="{{ auth()->user()->name ?? 'Usuario no identificado' }}"
                    readonly
                >
            </div>

        </div>

    </div>

</section>
<div class="botones">

<button
type="reset"
class="btn-limpiar"
>
{{ isset($censo) ? 'Restablecer' : 'Limpiar' }}
</button>

<button
type="submit"
class="btn-guardar"
>
{{ isset($censo) ? 'Guardar cambios' : 'Guardar registro' }}
</button>

</div>


</form>
</div>
</main>
</div>

<script>
// HABILITAR CAMPOS DE SIEMBRA
function habilitarCultivo() {

    const siembra = document.getElementById('siembra');
    const cultivo = document.getElementById('tipo_cultivo');
    const cantidad = document.getElementById('cantidad_siembra');
    const unidad = document.getElementById('unidad_siembra');

    if (!siembra || !cultivo || !cantidad || !unidad) {
        return;
    }

    const habilitado = siembra.value === 'Si';

    cultivo.disabled = !habilitado;
    cantidad.disabled = !habilitado;
    unidad.disabled = !habilitado;


    if (!habilitado) {
        cultivo.value = '';
        cantidad.value = '';
        unidad.value = '';
    }
}

document.addEventListener('DOMContentLoaded', habilitarCultivo);

// Campos agrícolas del esposo, independientes de los de la esposa.
function habilitarCultivoEsposo() {
    const siembra = document.getElementById('siembra_esposo');
    const cultivo = document.getElementById('tipo_cultivo_esposo');
    const cantidad = document.getElementById('cantidad_siembra_esposo');
    const unidad = document.getElementById('unidad_siembra_esposo');

    if (!siembra || !cultivo || !cantidad || !unidad) return;

    const habilitado = siembra.value === 'Si';
    [cultivo, cantidad, unidad].forEach(campo => {
        campo.disabled = !habilitado;
        if (!habilitado) campo.value = '';
    });
}
document.addEventListener('DOMContentLoaded', habilitarCultivoEsposo);

/* =========================================
   DEPARTAMENTO -> MUNICIPIO
========================================= */

function cargarMunicipio() {

    const departamento =
        document.getElementById('departamento');

    const municipio =
        document.getElementById('municipio');

    const comunidad =
        document.getElementById('comunidad');


    municipio.innerHTML =
        '<option value="">Seleccione un municipio</option>';

    comunidad.innerHTML =
        '<option value="">Seleccione una comunidad</option>';


    municipio.disabled = true;
    comunidad.disabled = true;


    if (departamento.value === 'Jutiapa') {

        municipio.disabled = false;

        const opcion =
            document.createElement('option');

        opcion.value = 'Jalpatagua';
        opcion.textContent = 'Jalpatagua';

        municipio.appendChild(opcion);

    }

}



/* =========================================
   MUNICIPIO -> COMUNIDADES
========================================= */

function cargarComunidades() {

    const municipio =
        document.getElementById('municipio');

    const comunidad =
        document.getElementById('comunidad');


    comunidad.innerHTML =
        '<option value="">Seleccione una comunidad</option>';

    comunidad.disabled = true;


    if (municipio.value !== 'Jalpatagua') {
        return;
    }


    const comunidades = [

        'Aldea Azulco',

        'Aldea El Aceituno',

        'Aldea El Amate',

        'Aldea El Coco',

        'Aldea El Cuje',

        'Aldea El Llano I',

        'Aldea El Retozadero',

        'Aldea El Sitio',

        'Aldea El Zapote',

        'Aldea Jicaral',

        'Aldea La Puerta',

        'Aldea La Unión',

        'Aldea Las Moritas',

        'Aldea Monzón',

        'Aldea Pajonal',

        'Aldea San Francisco',

        'Aldea San Jerónimo',

        'Aldea San Jose La Loma',

        'Aldea Sanixtan',

        'Aldea Sapuyuca',

        'Aldea Tierra Blanca',

        'Aldea Valle Nuevo',

        'Cabecera Municipal',

        'Caserío Agua Tibia, Aldea Monzón',

        'Caserío Buenos Aires, Aldea Azulco',

        'Caserío El Carrizo Aldea El Cuje',

        'Caserío El Guayabo, Aldea El Coco',

        'Caserío El Marillo Aldea Azulco',

        'Caserío El Quequesque, Aldea Azulco',

        'Caserío El Talnetal, Aldea Monzón',

        'Caserío El Tename, Aldea El Cuje',

        'Caserío La Esperanza, Aldea Jicaral',

        'Caserío La Frontera Aldea Valle Nuevo',

        'Caserío La Toma, Aldea Las Moritas',

        'Caserío San José El Llano 2, Aldea El Llano I',

        'Caserío Sarzalito, Aldea Monzón',

        'Colonia El Gozo Casco Urbano'

    ];


    comunidad.disabled = false;


    comunidades.forEach(function(nombre) {

        const opcion =
            document.createElement('option');

        opcion.value = nombre;
        opcion.textContent = nombre;

        comunidad.appendChild(opcion);

    });

}

function habilitarDireccion() {
    const comunidad = document.getElementById("comunidad");
    const direccion = document.getElementById("direccion");

    if (comunidad.value !== "") {
        direccion.disabled = false;
        direccion.placeholder = "Ingrese la dirección";
    } else {
        direccion.disabled = true;
        direccion.value = "";
        direccion.placeholder = "Seleccione primero una comunidad";
    }
}
function calcularEdadEsposo() {

    const fechaCampo = document.getElementById('fecha_nacimiento_esposo');
    const campoEdad = document.getElementById('edad_esposo');

    if (!fechaCampo.value) {
        campoEdad.value = '';
        return;
    }

    const fecha = new Date(fechaCampo.value + 'T00:00:00');
    const hoy = new Date();

    // No permitir años menores de 1900 ni fechas futuras
    if (fecha.getFullYear() < 1900 || fecha > hoy) {
        alert('Ingrese una fecha de nacimiento válida.');
        fechaCampo.value = '';
        campoEdad.value = '';
        return;
    }


    let edad = hoy.getFullYear() - fecha.getFullYear();
    const diferenciaMes = hoy.getMonth() - fecha.getMonth();

    if (
        diferenciaMes < 0 ||
        (diferenciaMes === 0 && hoy.getDate() < fecha.getDate())
    ) {
        edad--;
    }

    campoEdad.value = edad;
}

// CALCULAR EDAD DE LA ESPOSA
function calcularEdadEsposa() {

    const fechaCampo = document.getElementById('fecha_nacimiento_esposa');
    const campoEdad = document.getElementById('edad_esposa');

    if (!fechaCampo.value) {
        campoEdad.value = '';
        return;
    }

    const fecha = new Date(fechaCampo.value + 'T00:00:00');
    const hoy = new Date();

    // No permitir años menores de 1900 ni fechas futuras
    if (fecha.getFullYear() < 1900 || fecha > hoy) {
        alert('Ingrese una fecha de nacimiento válida.');
        fechaCampo.value = '';
        campoEdad.value = '';
        return;
    }

    let edad = hoy.getFullYear() - fecha.getFullYear();
    const diferenciaMes = hoy.getMonth() - fecha.getMonth();

    if (
        diferenciaMes < 0 ||
        (diferenciaMes === 0 && hoy.getDate() < fecha.getDate())
    ) {
        edad--;
    }

    campoEdad.value = edad;
}
/* =========================================
   AL LIMPIAR EL FORMULARIO
========================================= */

document.querySelector('.formulario')
.addEventListener('reset', function() {

    setTimeout(function() {

        const municipio =
            document.getElementById('municipio');

        const comunidad =
            document.getElementById('comunidad');


        municipio.innerHTML =
            '<option value="">Seleccione un municipio</option>';

        comunidad.innerHTML =
            '<option value="">Seleccione una comunidad</option>';


        municipio.disabled = true;
        comunidad.disabled = true;
        habilitarDireccion();
        habilitarCultivo();
        habilitarCultivoEsposo();

    }, 0);

});

let contadorHijos = 0;

function mostrarHijos() {
    const tieneHijos = document.getElementById('tiene_hijos');
    const contenedor = document.getElementById('contenedor_hijos');
    const lista = document.getElementById('lista_hijos');

    if (tieneHijos.value === 'Si') {
        contenedor.style.display = 'block';

        if (lista.children.length === 0) {
            agregarHijo();
        }
    } else {
        contenedor.style.display = 'none';
        lista.innerHTML = '';
    }
}

function agregarHijo() {
    contadorHijos++;

    const numero = contadorHijos;
    const lista = document.getElementById('lista_hijos');

    const bloque = document.createElement('div');
    bloque.className = 'bloque-hijo';
    bloque.style.marginBottom = '25px';
    bloque.style.padding = '15px';
    bloque.style.border = '1px solid #d5dce5';
    bloque.style.borderRadius = '8px';

    bloque.innerHTML = `
        <h4 style="margin-bottom: 20px;">
            Información del hijo
        </h4>

        <div class="campos-tres">

            <div class="campo">
                <label>Primer nombre</label>
                <input type="text"
                       name="hijos[${numero}][primer_nombre]"
                       oninput="this.value=this.value.replace(/[0-9]/g,'')"
                       required>
            </div>

            <div class="campo">
                <label>Segundo nombre</label>
                <input type="text"
                       name="hijos[${numero}][segundo_nombre]"
                       oninput="this.value=this.value.replace(/[0-9]/g,'')">
            </div>

            <div class="campo">
                <label>Tercer nombre</label>
                <input type="text"
                       name="hijos[${numero}][tercer_nombre]"
                       oninput="this.value=this.value.replace(/[0-9]/g,'')">
            </div>

            <div class="campo">
                <label>Primer apellido</label>
                <input type="text"
                       name="hijos[${numero}][primer_apellido]"
                       oninput="this.value=this.value.replace(/[0-9]/g,'')"
                       required>
            </div>

            <div class="campo">
                <label>Segundo apellido</label>
                <input type="text"
                       name="hijos[${numero}][segundo_apellido]"
                       oninput="this.value=this.value.replace(/[0-9]/g,'')">
            </div>

            <div class="campo">
                <label>No. de CUI</label>
                <input type="text"
                       name="hijos[${numero}][cui]"
                       inputmode="numeric"
                       maxlength="13"
                       pattern="[0-9]{13}"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,13)"
                       placeholder="Ingrese los 13 dígitos del CUI">
            </div>

            <div class="campo">
                <label>Fecha de nacimiento</label>
                <input type="date"
                       name="hijos[${numero}][fecha_nacimiento]"
                       max="${new Date().toLocaleDateString('en-CA')}"
                       onchange="calcularEdadHijo(this)"
                       required>
            </div>

            <div class="campo">
                <label>Edad</label>
                <input type="number"
                       name="hijos[${numero}][edad]"
                       placeholder="Edad"
                       readonly>
            </div>

            <div class="campo">
                <label>¿Presenta desnutrición?</label>
                <select name="hijos[${numero}][desnutricion]" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>

        </div>

        <button type="button"
                onclick="eliminarHijo(this)"
                style="margin-top: 15px; padding: 8px 15px; cursor: pointer;">
            Eliminar hijo
        </button>
    `;

    lista.appendChild(bloque);
}

function eliminarHijo(boton) {
    boton.closest('.bloque-hijo').remove();

    const lista = document.getElementById('lista_hijos');

    if (lista.children.length === 0) {
        document.getElementById('tiene_hijos').value = 'No';
        mostrarHijos();
    }
}

function calcularEdadHijo(campoFecha) {
    const bloque = campoFecha.closest('.bloque-hijo');
    const campoEdad = bloque.querySelector('input[name$="[edad]"]');

    campoEdad.value = '';

    if (!campoFecha.value) return;

    const partes = campoFecha.value.split('-').map(Number);
    const fecha = new Date(partes[0], partes[1] - 1, partes[2]);
    const hoy = new Date();

    if (partes[0] < 1900 ||
        fecha.getFullYear() !== partes[0] ||
        fecha.getMonth() !== partes[1] - 1 ||
        fecha.getDate() !== partes[2] ||
        fecha > hoy) {
        alert('Ingrese una fecha de nacimiento válida.');
        campoFecha.value = '';
        return;
    }

    let edad = hoy.getFullYear() - fecha.getFullYear();

    if (
        hoy.getMonth() < fecha.getMonth() ||
        (hoy.getMonth() === fecha.getMonth() &&
         hoy.getDate() < fecha.getDate())
    ) {
        edad--;
    }

    campoEdad.value = edad;
}

document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.getElementById('tiene_hijos')?.closest('form');

    if (formulario) {
        formulario.addEventListener('reset', function () {
            setTimeout(function () {
                document.getElementById('contenedor_hijos').style.display = 'none';
                document.getElementById('lista_hijos').innerHTML = '';
                contadorHijos = 0;
            }, 0);
        });
    }
});



/* Menú adaptable a teléfonos */
(function () {
    const boton = document.getElementById('boton-menu-movil');
    const fondo = document.getElementById('fondo-menu-movil');
    const menu = document.getElementById('menu-lateral');
    if (!boton || !fondo || !menu) return;

    function cambiarMenu(abierto) {
        document.body.classList.toggle('menu-movil-abierto', abierto);
        boton.setAttribute('aria-expanded', String(abierto));
        boton.setAttribute('aria-label', abierto ? 'Cerrar menú' : 'Abrir menú');
    }
    boton.addEventListener('click', function () {
        cambiarMenu(!document.body.classList.contains('menu-movil-abierto'));
    });
    fondo.addEventListener('click', function () { cambiarMenu(false); });
    menu.querySelectorAll('a').forEach(function (enlace) {
        enlace.addEventListener('click', function () { cambiarMenu(false); });
    });
    document.addEventListener('keydown', function (evento) {
        if (evento.key === 'Escape') cambiarMenu(false);
    });
    window.addEventListener('resize', function () {
        if (window.innerWidth > 800) cambiarMenu(false);
    });
})();

</script>



@if(isset($censo))
<script>
document.addEventListener('DOMContentLoaded', function () {
    const datos = @json(old() ?: $datos);
    const hijos = @json(old('hijos', $hijos ?? []));
    const formulario = document.querySelector('form.formulario');
    if (!formulario) return;
    const asignar = (nombre, valor) => {
        const campo = Array.from(formulario.elements).find(e => e.name === nombre);
        if (!campo || campo.type === 'file' || valor === null || typeof valor === 'object') return;
        campo.value = String(valor);
    };
    asignar('departamento', datos.departamento);
    if (typeof cargarMunicipio === 'function') cargarMunicipio();
    asignar('municipio', datos.municipio);
    if (typeof cargarComunidades === 'function') cargarComunidades();
    asignar('comunidad', datos.comunidad);
    if (typeof habilitarDireccion === 'function') habilitarDireccion();
    Object.entries(datos).forEach(([nombre, valor]) => asignar(nombre, valor));
    if (typeof habilitarCultivo === 'function') habilitarCultivo();
    if (typeof habilitarCultivoEsposo === 'function') habilitarCultivoEsposo();
    // Reapply agricultural values after dependent selects are enabled.
    ['tipo_cultivo','cantidad_siembra','unidad_siembra','tipo_cultivo_esposo','cantidad_siembra_esposo','unidad_siembra_esposo'].forEach(nombre => asignar(nombre, datos[nombre]));
    if (typeof calcularEdadEsposo === 'function' && datos.fecha_nacimiento_esposo) calcularEdadEsposo();
    if (typeof calcularEdadEsposa === 'function' && datos.fecha_nacimiento_esposa) calcularEdadEsposa();
    const lista = document.getElementById('lista_hijos');
    if (lista) lista.innerHTML = '';
    contadorHijos = 0;
    const registros = Array.isArray(hijos) ? hijos : Object.values(hijos || {});
    if (datos.tiene_hijos === 'Si' || registros.length) {
        asignar('tiene_hijos', 'Si');
        document.getElementById('contenedor_hijos').style.display = 'block';
        registros.forEach(hijo => {
            agregarHijo();
            const bloque = lista.lastElementChild;
            if (!bloque) return;
            Object.entries(hijo).forEach(([clave, valor]) => {
                const campo = Array.from(bloque.querySelectorAll('[name]')).find(e => e.name.endsWith('[' + clave + ']'));
                if (campo && valor !== null) campo.value = String(valor);
            });
            const fecha = bloque.querySelector('input[name$="[fecha_nacimiento]"]');
            if (fecha && fecha.value && typeof calcularEdadHijo === 'function') calcularEdadHijo(fecha);
        });
        if (!registros.length) agregarHijo();
    } else {
        asignar('tiene_hijos', 'No');
        document.getElementById('contenedor_hijos').style.display = 'none';
    }
});
</script>
@endif

</body>

</html>
