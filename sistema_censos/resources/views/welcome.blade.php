
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes censales | Aplicación Web Censal</title>

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

        .sidebar {
            width: 250px;
            background: #12335b;
            color: white;
            padding: 25px 18px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1100;
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

        .principal {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .barra-superior {
            min-height: 72px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 35px;
            border-bottom: 1px solid #e5e7eb;
            gap: 15px;
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
            margin-top: 3px;
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
            margin-bottom: 7px;
        }

        .encabezado p {
            color: #6b7280;
            font-size: 14px;
        }

        .estadisticas {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .tarjeta, .panel {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        .tarjeta p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .tarjeta h3 {
            font-size: 32px;
            color: #12335b;
        }

        .panel {
            margin-bottom: 25px;
        }

        .panel h3 {
            color: #12335b;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .filtros {
            display: grid;
            grid-template-columns: 1fr 1fr auto auto;
            align-items: end;
            gap: 15px;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .campo label {
            font-size: 14px;
            font-weight: bold;
        }

        .campo input, .campo select {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: white;
            font-size: 14px;
        }

        .btn {
            min-height: 42px;
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
            cursor: pointer;
            display: inline-block;
        }

        .btn-azul {
            background: #12335b;
            color: white;
        }

        .btn-gris {
            background: #e5e7eb;
            color: #374151;
        }

        .tabla-contenedor {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f1f5f9;
            color: #12335b;
        }

        .sin-registros {
            padding: 25px;
            text-align: center;
            color: #6b7280;
        }

        .paginacion {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            font-size: 14px;
        }

        .paginas {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .paginas a, .paginas span {
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            background: #e5e7eb;
            color: #12335b;
        }

        .paginas .actual {
            background: #12335b;
            color: white;
        }

        .boton-menu-movil, .fondo-menu-movil {
            display: none;
        }

        @media (max-width: 1100px) {
            .filtros {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                width: min(285px, 85vw);
                height: 100dvh;
                transform: translateX(-105%);
                transition: transform .25s ease;
            }

            body.menu-movil-abierto .sidebar {
                transform: translateX(0);
            }

            .fondo-menu-movil {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(15,23,42,.52);
                z-index: 1090;
                opacity: 0;
                visibility: hidden;
            }

            body.menu-movil-abierto .fondo-menu-movil {
                opacity: 1;
                visibility: visible;
            }

            body.menu-movil-abierto {
                overflow: hidden;
            }

            .principal {
                margin-left: 0;
                width: 100%;
            }

            .barra-superior {
                padding: 12px 16px;
            }

            .barra-superior h1 {
                font-size: 18px;
            }

            .boton-menu-movil {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border: 1px solid #dbe3ed;
                border-radius: 8px;
                background: white;
                color: #12335b;
                font-size: 23px;
                cursor: pointer;
                margin-right: 8px;
            }

            .usuario strong {
                font-size: 12px;
            }

            .usuario span {
                font-size: 11px;
            }

            .contenido {
                padding: 20px 14px;
            }

            .estadisticas, .filtros {
                grid-template-columns: 1fr;
            }

            .tarjeta, .panel {
                padding: 18px 14px;
            }
        }
    </style>
</head>

<body>
<div class="contenedor">

    <aside class="sidebar" id="menu-lateral">
        <div class="logo">
            <img src="{{ asset('images/logo-municipalidad.png') }}"
                 alt="Municipalidad de Jalpatagua">
            <h2>Aplicación Web Censal</h2>
            <p>Municipalidad de Jalpatagua</p>
        </div>

        <nav class="menu">
            <a href="{{ route('inicio') }}">⌂ &nbsp; Inicio</a>
            <a href="{{ route('censos.index') }}">▣ &nbsp; Registro censal</a>
            <a href="{{ route('reportes.index') }}" class="activo">▤ &nbsp; Reportes</a>
            <a href="#">ⓘ &nbsp; Información</a>
            <a href="#">⚙ &nbsp; Administración</a>
        </nav>
    </aside>

    <div class="fondo-menu-movil" id="fondo-menu-movil"></div>

    <main class="principal">
        <header class="barra-superior">
            <div style="display:flex;align-items:center;">
                <button type="button"
                        class="boton-menu-movil"
                        id="boton-menu-movil"
                        aria-label="Abrir menú"
                        aria-expanded="false"
                        aria-controls="menu-lateral">☰</button>
                <h1>Reportes censales</h1>
            </div>

            <div class="usuario">
                <strong>{{ Auth::user()->name }}</strong>
                <span>Administrador</span>
            </div>
        </header>

        <div class="contenido">
            <div class="encabezado">
                <h2>Reportes censales</h2>
                <p>Consulta y seguimiento de los censos registrados en la Municipalidad de Jalpatagua.</p>
            </div>

            <div class="estadisticas">
                <div class="tarjeta">
                    <p>Total de censos registrados</p>
                    <h3>{{ $totalCensos }}</h3>
                </div>

                <div class="tarjeta">
                    <p>Comunidades censadas</p>
                    <h3>{{ $totalComunidades }}</h3>
                </div>
            </div>

            <div class="panel">
                <h3>Filtros de búsqueda</h3>

                <form action="{{ route('reportes.index') }}" method="GET" class="filtros">
                    <div class="campo">
                        <label for="comunidad">Comunidad</label>
                        <select name="comunidad" id="comunidad">
                            <option value="">Todas las comunidades</option>
                            @foreach($comunidades as $comunidad)
                                <option value="{{ $comunidad }}"
                                    {{ request('comunidad') == $comunidad ? 'selected' : '' }}>
                                    {{ $comunidad }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campo">
                        <label for="fecha">Fecha del censo</label>
                        <input type="date" name="fecha" id="fecha"
                               value="{{ request('fecha') }}">
                    </div>

                    <button type="submit" class="btn btn-azul">Buscar</button>
                    <a href="{{ route('reportes.index') }}" class="btn btn-gris">Limpiar</a>
                </form>
            </div>

            <div class="panel">
                <h3>Listado de censos registrados</h3>

                <div class="tabla-contenedor">
                    <table>
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Departamento</th>
                            <th>Municipio</th>
                            <th>Comunidad</th>
                            <th>Dirección</th>
                            <th>Fecha del censo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($censos as $censo)
                            <tr>
                                <td>{{ $censo->id }}</td>
                                <td>{{ $censo->departamento }}</td>
                                <td>{{ $censo->municipio }}</td>
                                <td>{{ $censo->comunidad }}</td>
                                <td>{{ $censo->direccion }}</td>
                                <td>{{ $censo->fecha_censo }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="sin-registros">
                                    No se encontraron censos registrados.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if($censos->hasPages())
                    <div class="paginacion">
                        <span>
                            Mostrando {{ $censos->firstItem() }}
                            a {{ $censos->lastItem() }}
                            de {{ $censos->total() }} registros
                        </span>

                        <div class="paginas">
                            @if($censos->onFirstPage())
                                <span>Anterior</span>
                            @else
                                <a href="{{ $censos->previousPageUrl() }}">Anterior</a>
                            @endif

                            <span class="actual">Página {{ $censos->currentPage() }}</span>

                            @if($censos->hasMorePages())
                                <a href="{{ $censos->nextPageUrl() }}">Siguiente</a>
                            @else
                                <span>Siguiente</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

<script>
    const botonMenu = document.getElementById('boton-menu-movil');
    const fondoMenu = document.getElementById('fondo-menu-movil');

    function cerrarMenu() {
        document.body.classList.remove('menu-movil-abierto');
        botonMenu.setAttribute('aria-expanded', 'false');
    }

    botonMenu.addEventListener('click', function () {
        const abierto = document.body.classList.toggle('menu-movil-abierto');
        botonMenu.setAttribute('aria-expanded', String(abierto));
    });

    fondoMenu.addEventListener('click', cerrarMenu);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') cerrarMenu();
    });
</script>
</body>
</html>
