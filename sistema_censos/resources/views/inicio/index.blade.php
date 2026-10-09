<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Aplicación Web Censal</title>

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

        /* MENÚ LATERAL */

        .sidebar {
            width: 250px;
            background: #12335b;
            color: white;
            padding: 25px 18px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1002;
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
            margin: 12px 0 5px;
            color: white;
        }

        .logo p {
            font-size: 12px;
            color: #dbeafe;
            margin: 0;
        }

        .menu a {
            display: block;
            padding: 14px 15px;
            margin-bottom: 7px;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-size: 15px;
            font-weight: normal;
        }

        .menu a:hover,
        .menu a.activo {
            background: #244d7c;
        }

        /* CONTENIDO PRINCIPAL */

        .principal {
            margin-left: 250px;
            min-height: 100vh;
        }

        .barra-superior {
            min-height: 72px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 35px;
            border-bottom: 1px solid #e5e7eb;
        }

        .barra-superior h1 {
            font-size: 22px;
            color: #12335b;
        }

        .encabezado-izquierdo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .usuario {
            text-align: right;
        }

        .usuario strong {
            display: block;
            font-size: 14px;
            color: #111827;
        }

        .usuario span {
            display: block;
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
        }

        .cerrar-sesion {
            border: none;
            background: none;
            color: #dc2626;
            font-size: 12px;
            cursor: pointer;
            margin-top: 3px;
        }

        .cerrar-sesion:hover {
            text-decoration: underline;
        }

        .contenido {
            padding: 30px 35px;
        }

        /* BIENVENIDA */

        .bienvenida {
            position: relative;
            width: 100%;
            min-height: 235px;
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 28px;
            background: #12335b;
        }

        .bienvenida img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .bienvenida::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(10, 35, 65, 0.58);
        }

        .texto-bienvenida {
            position: relative;
            z-index: 2;
            padding: 65px 40px;
            color: white;
            max-width: 720px;
        }

        .texto-bienvenida h2 {
            font-size: 30px;
            margin-bottom: 12px;
        }

        .texto-bienvenida p {
            font-size: 15px;
            line-height: 1.5;
        }

        /* TARJETAS DE MÓDULOS */

        .titulo-modulos {
            color: #12335b;
            font-size: 21px;
            margin-bottom: 18px;
        }

        .modulos {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .tarjeta {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            min-height: 165px;
            text-decoration: none;
            color: inherit;
            transition: 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .tarjeta:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        .icono {
            width: 42px;
            height: 42px;
            background: #edf4fb;
            color: #12335b;
            border-radius: 9px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 21px;
            margin-bottom: 16px;
        }

        .tarjeta h3 {
            color: #12335b;
            font-size: 17px;
            margin-bottom: 10px;
        }

        .tarjeta p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
        }

        /* BOTÓN MÓVIL */

        .boton-menu,
        .fondo-menu {
            display: none;
        }

        @media (max-width: 1200px) {
            .modulos {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 800px) {
            html, body {
                width: 100%;
                overflow-x: hidden;
            }

            .sidebar {
                width: min(280px, 85vw);
                height: 100dvh;
                transform: translateX(-105%);
                transition: transform .25s ease;
                box-shadow: 4px 0 20px rgba(0,0,0,.15);
            }

            .sidebar.abierto {
                transform: translateX(0);
            }

            .fondo-menu {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.45);
                z-index: 1001;
                opacity: 0;
                visibility: hidden;
                transition: opacity .25s ease;
            }

            .fondo-menu.visible {
                opacity: 1;
                visibility: visible;
            }

            .principal {
                margin-left: 0;
                width: 100%;
            }

            .barra-superior {
                padding: 12px 15px;
            }

            .barra-superior h1 {
                font-size: 18px;
            }

            .boton-menu {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                flex-shrink: 0;
                border: 1px solid #dbe3ee;
                border-radius: 8px;
                background: white;
                color: #12335b;
                font-size: 23px;
                cursor: pointer;
            }

            .usuario {
                max-width: 45%;
                overflow-wrap: anywhere;
            }

            .usuario strong {
                font-size: 12px;
            }

            .usuario span,
            .cerrar-sesion {
                font-size: 11px;
            }

            .contenido {
                padding: 20px 14px 30px;
            }

            .bienvenida {
                min-height: 220px;
            }

            .texto-bienvenida {
                padding: 35px 22px;
            }

            .texto-bienvenida h2 {
                font-size: 23px;
            }

            .texto-bienvenida p {
                font-size: 14px;
            }

            .modulos {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .tarjeta {
                min-height: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="fondo-menu"
     id="fondoMenu"
     onclick="cerrarMenu()">
</div>

<!-- MENÚ LATERAL -->

<aside class="sidebar" id="sidebar">

    <div class="logo">
        <img src="{{ asset('images/logo-municipalidad.png') }}"
             alt="Municipalidad de Jalpatagua">

        <h2>Aplicación Web Censal</h2>
        <p>Municipalidad de Jalpatagua</p>
    </div>

    <nav class="menu">

        <a href="{{ route('inicio') }}"
           class="{{ request()->routeIs('inicio') ? 'activo' : '' }}">
            Inicio
        </a>

        <a href="{{ route('censos.index') }}"
           class="{{ request()->routeIs('censos.*') ? 'activo' : '' }}">
            Registro censal
        </a>

        @can('administrar-sistema')
        <a href="{{ route('reportes.index') }}"
           class="{{ request()->routeIs('reportes.*') ? 'activo' : '' }}">
            Reportes
        </a>
        @endcan

        <a href="{{ route('informacion.index') }}"
           class="{{ request()->routeIs('informacion.*') ? 'activo' : '' }}">
            Información
        </a>

        @can('administrar-sistema')
        <a href="{{ route('administracion.index') }}"
           class="{{ request()->routeIs('administracion.*') ? 'activo' : '' }}">
            Administración
        </a>
        @endcan

    </nav>
</aside>

<!-- CONTENIDO PRINCIPAL -->

<main class="principal">

    <header class="barra-superior">

        <div class="encabezado-izquierdo">

            <button type="button"
                    class="boton-menu"
                    id="botonMenu"
                    onclick="alternarMenu()"
                    aria-label="Abrir menú"
                    aria-controls="sidebar"
                    aria-expanded="false">
                ☰
            </button>

            <h1>Inicio</h1>

        </div>

        <div class="usuario">

            <strong>{{ Auth::user()->name }}</strong>

            <span>{{ Auth::user()->esAdministrador() ? 'Administrador' : 'Usuario normal' }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="cerrar-sesion">
                    Cerrar sesión
                </button>
            </form>

        </div>

    </header>

    <div class="contenido">

        <!-- BIENVENIDA -->

        <section class="bienvenida">

            <img src="{{ asset('images/municipalidad-jalpatagua.jpg') }}"
                 alt="Municipalidad de Jalpatagua">

            <div class="texto-bienvenida">

                <h2>Bienvenido, {{ Auth::user()->name }}</h2>

                <p>
                    Sistema para el registro, consulta y administración
                    de la información censal de la Municipalidad de
                    Jalpatagua, Jutiapa.
                </p>

            </div>

        </section>

        <!-- MÓDULOS -->

        <h2 class="titulo-modulos">
            Módulos del sistema
        </h2>

        <section class="modulos">

            <a href="{{ route('censos.index') }}" class="tarjeta">

                <div class="icono">▣</div>

                <h3>Registro censal</h3>

                <p>
                    Registre la información de las viviendas
                    y de las personas censadas.
                </p>

            </a>

            @can('administrar-sistema')
            <a href="{{ route('reportes.index') }}" class="tarjeta">

                <div class="icono">▤</div>

                <h3>Reportes</h3>

                <p>
                    Consulte y genere reportes de la información
                    censal registrada.
                </p>

            </a>
            @endcan

            <a href="{{ route('informacion.index') }}" class="tarjeta">

                <div class="icono">ⓘ</div>

                <h3>Información</h3>

                <p>
                    Consulte las comunidades y la información
                    de sus integrantes del COCODE.
                </p>

            </a>

            @can('administrar-sistema')
            <a href="{{ route('administracion.index') }}" class="tarjeta">

                <div class="icono">⚙</div>

                <h3>Administración</h3>

                <p>
                    Administre los usuarios y permisos
                    de acceso a la aplicación.
                </p>

            </a>
            @endcan

        </section>

    </div>

</main>

<script>
    function alternarMenu() {
        const menu = document.getElementById('sidebar');
        const fondo = document.getElementById('fondoMenu');
        const boton = document.getElementById('botonMenu');

        const abierto = menu.classList.toggle('abierto');

        fondo.classList.toggle('visible', abierto);

        boton.setAttribute('aria-expanded', String(abierto));
        boton.setAttribute(
            'aria-label',
            abierto ? 'Cerrar menú' : 'Abrir menú'
        );
    }

    function cerrarMenu() {
        const menu = document.getElementById('sidebar');
        const fondo = document.getElementById('fondoMenu');
        const boton = document.getElementById('botonMenu');

        menu.classList.remove('abierto');
        fondo.classList.remove('visible');

        boton.setAttribute('aria-expanded', 'false');
        boton.setAttribute('aria-label', 'Abrir menú');
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            cerrarMenu();
        }
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth > 800) {
            cerrarMenu();
        }
    });
</script>

</body>
</html>
