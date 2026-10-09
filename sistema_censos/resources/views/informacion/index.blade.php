
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de COCODES</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #243247;
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
            z-index: 30;
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
            background: white;
            border-bottom: 1px solid #e5e7eb;
            min-height: 72px;
            padding: 12px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .barra-superior h1 {
            margin: 0;
            color: #12335b;
            font-size: 22px;
        }

        .titulo-barra {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        /* USUARIO, ROL Y CERRAR SESIÓN */

        .usuario {
            text-align: right;
            flex-shrink: 0;
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

        .usuario form {
            margin: 0;
        }

        .cerrar-sesion {
            border: none;
            background: none;
            color: #dc2626;
            font-size: 12px;
            cursor: pointer;
            margin-top: 3px;
            padding: 0;
        }

        .cerrar-sesion:hover {
            text-decoration: underline;
        }

        .contenido {
            padding: 30px 35px;
        }

        .encabezado h2 {
            color: #12335b;
            margin: 0 0 8px;
        }

        .encabezado p {
            color: #64748b;
            margin-bottom: 25px;
        }

        /* TARJETAS */

        .tarjeta {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .tarjeta h3 {
            margin-top: 0;
            color: #12335b;
        }

        /* BUSCADOR */

        .buscador {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
        }

        .buscador:focus {
            outline: none;
            border-color: #244d7c;
        }

        /* COMUNIDADES */

        .comunidad {
            border: 1px solid #e5e7eb;
            border-radius: 9px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .comunidad summary {
            padding: 17px;
            background: #f1f5f9;
            color: #12335b;
            font-weight: bold;
            cursor: pointer;
        }

        .comunidad summary:hover {
            background: #e2e8f0;
        }

        .tabla-contenedor {
            overflow-x: auto;
            padding: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        th {
            background: #f8fafc;
            color: #12335b;
        }

        .sin-resultados {
            display: none;
            color: #64748b;
            text-align: center;
            padding: 20px;
        }

        /* MENÚ PARA CELULARES */

        .boton-menu-movil {
            display: none;
            border: 1px solid #cbd5e1;
            background: white;
            border-radius: 7px;
            padding: 7px 11px;
            font-size: 22px;
            cursor: pointer;
            color: #12335b;
        }

        .fondo-menu-movil {
            display: none;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: min(285px, 85vw);
                height: 100dvh;
                bottom: auto;
                transform: translateX(-105%);
                transition: transform 0.25s ease;
            }

            body.menu-movil-abierto .sidebar {
                transform: translateX(0);
            }

            body.menu-movil-abierto .fondo-menu-movil {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.55);
                z-index: 20;
            }

            body.menu-movil-abierto {
                overflow: hidden;
            }

            .principal {
                margin-left: 0;
            }

            .contenido {
                padding: 20px 15px;
            }

            .barra-superior {
                padding: 12px 15px;
            }

            .barra-superior h1 {
                font-size: 18px;
            }

            .boton-menu-movil {
                display: inline-block;
                flex-shrink: 0;
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

            .tarjeta {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<!-- MENÚ LATERAL -->

<aside class="sidebar" id="menu-lateral">

    <div class="logo">

        <img
            src="{{ asset('images/logo-municipalidad.png') }}"
            alt="Municipalidad de Jalpatagua"
        >

        <h2>Aplicación Web Censal</h2>

        <p>Municipalidad de Jalpatagua</p>

    </div>

    <nav class="menu" aria-label="Navegación principal">

        <a href="{{ route('inicio') }}">
            Inicio
        </a>

        <a href="{{ route('censos.index') }}">
            Registro censal
        </a>

        @can('administrar-sistema')
        <a href="{{ route('reportes.index') }}">
            Reportes
        </a>
        @endcan

        <a
            href="{{ route('informacion.index') }}"
            class="activo"
            aria-current="page"
        >
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

<!-- FONDO OSCURO DEL MENÚ MÓVIL -->

<div
    class="fondo-menu-movil"
    id="fondo-menu-movil">
</div>

<!-- CONTENIDO PRINCIPAL -->

<main class="principal">

    <header class="barra-superior">

        <div class="titulo-barra">

            <button
                type="button"
                class="boton-menu-movil"
                id="boton-menu-movil"
                aria-label="Abrir menú"
                aria-expanded="false"
                aria-controls="menu-lateral"
            >
                ☰
            </button>

            <h1>Información de COCODES</h1>

        </div>

        <!-- USUARIO, ROL Y CERRAR SESIÓN -->

        <div class="usuario">

            <strong>{{ Auth::user()->name }}</strong>

            <span>
                {{ Auth::user()->esAdministrador() ? 'Administrador' : 'Usuario normal' }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="cerrar-sesion">
                    Cerrar sesión
                </button>
            </form>

        </div>

    </header>

    <div class="contenido">

        <!-- ENCABEZADO -->

        <div class="encabezado">

            <h2>
                Consejos Comunitarios de Desarrollo
            </h2>

            <p>
                Consulta de los integrantes de los COCODES
                de las 37 comunidades del municipio de
                Jalpatagua, Jutiapa.
            </p>

        </div>

        <!-- BUSCADOR -->

        <div class="tarjeta">

            <h3>Buscar comunidad</h3>

            <input
                type="search"
                id="buscarComunidad"
                class="buscador"
                placeholder="Escriba el nombre de una comunidad..."
            >

        </div>

        <!-- LISTADO DE COMUNIDADES -->

        <div class="tarjeta">

            <h3>Listado de comunidades</h3>

            @forelse(($comunidades ?? []) as $comunidad)

                <details
                    class="comunidad"
                    data-nombre="{{ mb_strtolower($comunidad['nombre']) }}"
                >

                    <summary>
                        {{ $comunidad['nombre'] }}
                    </summary>

                    <div class="tabla-contenedor">

                        <table>

                            <thead>
                                <tr>
                                    <th>Cargo</th>
                                    <th>Nombre completo</th>
                                    <th>Teléfono</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($comunidad['integrantes'] as $integrante)

                                    <tr>

                                        <td>
                                            {{ $integrante['cargo'] }}
                                        </td>

                                        <td>
                                            {{ $integrante['nombre'] }}
                                        </td>

                                        <td>
                                            {{ $integrante['telefono'] ?: 'No registrado' }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </details>

            @empty

                <p>
                    Todavía no se han cargado las comunidades.
                </p>

            @endforelse

            <p
                id="sinResultados"
                class="sin-resultados"
            >
                No se encontraron comunidades con ese nombre.
            </p>

        </div>

    </div>

</main>

<script>

    /* BUSCADOR DE COMUNIDADES */

    const buscador = document.getElementById('buscarComunidad');

    const comunidades = document.querySelectorAll('.comunidad');

    const sinResultados = document.getElementById('sinResultados');

    buscador.addEventListener('input', function () {

        const texto = this.value.toLocaleLowerCase().trim();

        let visibles = 0;

        comunidades.forEach(function (comunidad) {

            const nombre = comunidad.dataset.nombre;

            const coincide = nombre.includes(texto);

            comunidad.style.display = coincide ? '' : 'none';

            if (coincide) {
                visibles++;
            }

        });

        sinResultados.style.display =
            comunidades.length > 0 && visibles === 0
                ? 'block'
                : 'none';

    });

    /* MENÚ MÓVIL */

    const botonMenu = document.getElementById('boton-menu-movil');

    const fondoMenu = document.getElementById('fondo-menu-movil');

    function cerrarMenu() {

        document.body.classList.remove('menu-movil-abierto');

        botonMenu.setAttribute('aria-expanded', 'false');

        botonMenu.setAttribute('aria-label', 'Abrir menú');

    }

    botonMenu.addEventListener('click', function () {

        const abierto = document.body.classList.toggle(
            'menu-movil-abierto'
        );

        botonMenu.setAttribute(
            'aria-expanded',
            String(abierto)
        );

        botonMenu.setAttribute(
            'aria-label',
            abierto ? 'Cerrar menú' : 'Abrir menú'
        );

    });

    fondoMenu.addEventListener('click', cerrarMenu);

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            cerrarMenu();
        }

    });

    window.addEventListener('resize', function () {

        if (window.innerWidth > 800) {
            cerrarMenu();
        }

    });

</script>

</body>
</html>
