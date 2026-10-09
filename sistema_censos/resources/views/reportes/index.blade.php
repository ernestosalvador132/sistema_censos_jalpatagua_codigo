````
```
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Censales - Municipalidad de Jalpatagua</title>
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
            bottom: 0;
            left: 0;
            overflow-y: auto;
            z-index: 20;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            width: 95px;
            height: 95px;
            object-fit: contain;
            border-radius: 50%;
            background: white;
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
        .principal {
            margin-left: 250px;
            width: calc(100% - 250px);
        }
        .barra-superior {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            min-height: 72px;
            padding: 15px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }
        .barra-superior h1 {
            color: #12335b;
            font-size: 22px;
            margin: 0;
        }
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
            font-size: 25px;
        }
        .encabezado p {
            color: #64748b;
            font-size: 14px;
            margin: 0 0 25px;
        }
        .estadisticas {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        .tarjeta,
        .panel {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .tarjeta p {
            color: #64748b;
            font-size: 14px;
            margin: 0 0 12px;
        }
        .tarjeta h3 {
            color: #12335b;
            font-size: 32px;
            margin: 0;
        }
        .panel {
            margin-bottom: 25px;
        }
        .panel h3 {
            color: #12335b;
            font-size: 18px;
            margin: 0 0 20px;
        }
        .filtros {
            display: grid;
            grid-template-columns: repeat(2, minmax(220px, 1fr));
            gap: 15px;
            align-items: end;
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
        .campo input,
        .campo select {
            width: 100%;
            height: 42px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            padding: 0 12px;
            background: white;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 11px 16px;
            min-height: 42px;
            border-radius: 7px;
            border: none;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            white-space: nowrap;
        }
        .btn-azul {
            background: #12335b;
            color: white;
        }
        .btn-azul:hover {
            background: #244d7c;
        }
        .btn-editar { background:#12335b; color:white; }
        .btn-editar:hover { background:#244d7c; }
        .btn-dpi { background:#0f766e; color:white; }
        .btn-dpi:hover { background:#115e59; }
        .btn-eliminar { background:#dc3545; color:white; }
        .btn-eliminar:hover { background:#b91c1c; }
        .acciones-censo { display:flex; align-items:center; gap:8px; }
        .acciones-censo form { margin:0; }
        .btn-gris {
            background: #e5e7eb;
            color: #374151;
        }
        .exportaciones { display:flex; gap:12px; flex-wrap:wrap; margin-top:18px; align-items:center; }
        .btn-pdf { background:#b91c1c; color:white; }
        .btn-excel { background:#15803d; color:white; }
        .nota-reportes { font-size:13px; color:#64748b; margin:14px 0 0; }
        .tabla-contenedor {
            width: 100%;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th,
        td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        th {
            background: #f1f5f9;
            color: #12335b;
            white-space: nowrap;
        }
        tbody tr:hover {
            background: #f8fafc;
        }
        .sin-registros {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }
        .paginacion {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
            font-size: 14px;
        }
        .paginas {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .paginas a,
        .paginas span {
            display: inline-block;
            padding: 9px 12px;
            background: #e5e7eb;
            border-radius: 6px;
            text-decoration: none;
            color: #12335b;
        }
        .paginas .actual {
            background: #12335b;
            color: white;
        }
        .boton-menu-movil,
        .fondo-menu-movil {
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
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, .55);
                z-index: 15;
            }
            body.menu-movil-abierto .fondo-menu-movil {
                display: block;
            }
            body.menu-movil-abierto {
                overflow: hidden;
            }
            .principal {
                width: 100%;
                margin-left: 0;
            }
            .barra-superior {
                padding: 12px 16px;
            }
            .barra-superior h1 {
                font-size: 18px;
            }
            .boton-menu-movil {
                display: inline-block;
                padding: 8px 12px;
                margin-right: 10px;
                border: 1px solid #cbd5e1;
                border-radius: 7px;
                background: white;
                font-size: 20px;
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
                padding: 20px 14px;
            }
            .tarjeta,
            .panel {
                padding: 18px 14px;
            }
            .estadisticas,
            .filtros {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="contenedor">
    <!-- MENÚ LATERAL -->
    <aside class="sidebar" id="menu-lateral">
        <div class="logo">
            <img src="{{ asset('images/logo-municipalidad.png') }}"
                 alt="Municipalidad de Jalpatagua">
            <h2>Aplicación Web Censal</h2>
            <p>Municipalidad de Jalpatagua</p>
        </div>
        <nav class="menu">
            <a href="{{ route('inicio') }}">
                Inicio
            </a>
            <a href="{{ route('censos.index') }}">
                Registro censal
            </a>
            @can('administrar-sistema')
            <a href="{{ route('reportes.index') }}" class="activo">
                Reportes
            </a>
            @endcan
            <a href="{{ route('informacion.index') }}">
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
    <div class="fondo-menu-movil" id="fondo-menu-movil"></div>
    <!-- CONTENIDO PRINCIPAL -->
    <main class="principal">
        <header class="barra-superior">
            <div style="display:flex;align-items:center;">
                <button type="button"
                        class="boton-menu-movil"
                        id="boton-menu-movil"
                        aria-label="Abrir menú"
                        aria-expanded="false"
                        aria-controls="menu-lateral">
                    ☰
                </button>
                <h1>Reportes censales</h1>
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
            <div class="encabezado">
                <h2>Reportes censales</h2>
                <p>
                    Consulta de la información censal registrada
                    en la Municipalidad de Jalpatagua, Jutiapa.
                </p>
            </div>
            <!-- ESTADÍSTICAS -->
            <div class="estadisticas">
                <div class="tarjeta">
                    <p>Total Familias Censadas</p>
                    <h3>{{ $totalCensos }}</h3>
                </div>
                <div class="tarjeta">
                    <p>Comunidades censadas</p>
                    <h3>{{ $totalComunidades }}</h3>
                </div>
            </div>
            <!-- FILTROS Y EXPORTACIÓN DE REPORTES -->
            <div class="panel">
                <h3>Seleccionar reporte</h3>
                <form action="{{ route('reportes.index') }}" method="GET" class="filtros" id="formulario-reportes">
                    <div class="campo">
                        <label for="tipo_reporte">Tipo de reporte</label>
                        <select name="tipo_reporte" id="tipo_reporte" onchange="actualizarFiltrosReporte(false)">
                            @foreach($tiposReporte as $clave => $nombre)
                            <option value="{{ $clave }}" {{ $tipoReporte === $clave ? 'selected' : '' }}>{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="campo" id="campo-comunidad">
                        <label for="comunidad">Comunidad</label>
                        <select name="comunidad" id="comunidad">
                            <option value="">Todas las comunidades</option>
                            @foreach($comunidades as $comunidad)
                                <option value="{{ $comunidad }}" {{ request('comunidad') == $comunidad ? 'selected' : '' }}>
                                    {{ $comunidad }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="campo" id="campo-criterio" style="display:none;">
                        <label for="campo">Criterio del reporte</label>
                        <select name="campo" id="campo"></select>
                    </div>
                    <div class="campo" id="campo-valor" style="display:none;">
                        <label for="valor">Valor a consultar</label>
                        <select name="valor" id="valor"></select>
                    </div>
                    <button type="submit" class="btn btn-azul">Generar reporte</button>
                    <a href="{{ route('reportes.index') }}" class="btn btn-gris">Limpiar</a>
                </form>
                <div class="exportaciones">
                    <button type="button" class="btn btn-pdf" onclick="exportarReporte('pdf')">Exportar PDF</button>
                    <button type="button" class="btn btn-excel" onclick="exportarReporte('excel')">Exportar Excel</button>
                </div>
                <p class="nota-reportes">Las exportaciones incluyen todos los registros que cumplan los filtros seleccionados.</p>
            </div>
            <!-- TABLA DE CENSOS -->
            <div class="panel">
                <h3>Resultados del reporte: {{ $tiposReporte[$tipoReporte] ?? 'Reporte general' }}</h3>
                <form method="GET" action="{{ route('reportes.index') }}" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-bottom:20px;">
                    <input type="hidden" name="tipo_reporte" value="{{ request('tipo_reporte', 'general') }}">
                    @if(request('comunidad'))<input type="hidden" name="comunidad" value="{{ request('comunidad') }}">@endif
                    @if(request('campo'))<input type="hidden" name="campo" value="{{ request('campo') }}">@endif
                    @if(request()->has('valor'))<input type="hidden" name="valor" value="{{ request('valor') }}">@endif
                    <input type="search" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar nombre o apellido del esposo o esposa" aria-label="Buscar persona censada" style="flex:1;min-width:260px;max-width:560px;height:43px;padding:10px 13px;border:1px solid #cbd5e1;border-radius:7px;font-size:14px;">
                    <button type="submit" class="btn btn-azul">Buscar</button>
                    <a href="{{ route('reportes.index', request()->except(['buscar', 'page'])) }}" class="btn btn-gris">Quitar búsqueda</a>
                </form>
                <div class="tabla-contenedor">
                    @php
                    $columnasExtra = match($tipoReporte) {
                        'vivienda' => ['material_paredes' => 'Paredes', 'material_piso' => 'Piso', 'material_techo' => 'Techo', 'red_agua' => 'Agua', 'red_drenajes' => 'Drenajes', 'red_energia_electrica' => 'Electricidad', 'tenencia_vivienda' => 'Tenencia'],
                        'poblacion' => ['edad_esposo' => 'Edad esposo', 'grupo_etnico_esposo' => 'Etnia esposo', 'edad_esposa' => 'Edad esposa', 'grupo_etnico_esposa' => 'Etnia esposa', 'tiene_hijos' => 'Tiene hijos'],
                        'educacion' => ['sabe_leer_escribir_esposo' => 'Lee/escribe esposo', 'ultimo_grado_aprobado_esposo' => 'Escolaridad esposo', 'sabe_leer_escribir_esposa' => 'Lee/escribe esposa', 'ultimo_grado_aprobado_esposa' => 'Escolaridad esposa'],
                        'agricultura' => ['siembra_esposo' => 'Siembra esposo', 'tipo_cultivo_esposo' => 'Cultivo esposo', 'cantidad_siembra_esposo' => 'Cantidad esposo', 'unidad_siembra_esposo' => 'Unidad esposo', 'siembra' => 'Siembra esposa', 'tipo_cultivo' => 'Cultivo esposa', 'cantidad_siembra' => 'Cantidad esposa', 'unidad_siembra' => 'Unidad esposa'],
                        'discapacidad' => ['discapacidad_esposo' => 'Discapacidad esposo', 'discapacidad_esposa' => 'Discapacidad esposa'],
                        'desnutricion' => ['tiene_hijos' => 'Tiene hijos'],
                        default => [],
                    };
                    @endphp
                    <table>
                        <thead>
                            <tr>
                                <th>Familias censadas</th>
                                <th>Nombre del esposo</th>
                                <th>Apellidos del esposo</th>
                                <th>Nombre de la esposa</th>
                                <th>Apellidos de la esposa</th>
                                <th>Comunidad</th>
                                <th>Dirección</th>
                                <th>Fecha del censo</th>
                                @foreach($columnasExtra as $etiqueta)
                                <th>{{ $etiqueta }}</th>
                                @endforeach
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($censos as $censo)
                            @php
                            $datosCenso = json_decode($censo->datos ?? '{}', true);
                            $datosCenso = is_array($datosCenso) ? $datosCenso : [];
                            $nombreEsposo = trim(implode(' ', array_filter([$datosCenso['primer_nombre_esposo'] ?? '', $datosCenso['segundo_nombre_esposo'] ?? '', $datosCenso['tercer_nombre_esposo'] ?? ''])));
                            $apellidoEsposo = trim(implode(' ', array_filter([$datosCenso['primer_apellido_esposo'] ?? '', $datosCenso['segundo_apellido_esposo'] ?? ''])));
                            $nombreEsposa = trim(implode(' ', array_filter([$datosCenso['primer_nombre_esposa'] ?? '', $datosCenso['segundo_nombre_esposa'] ?? '', $datosCenso['tercer_nombre_esposa'] ?? ''])));
                            $apellidoEsposa = trim(implode(' ', array_filter([$datosCenso['primer_apellido_esposa'] ?? '', $datosCenso['segundo_apellido_esposa'] ?? '', $datosCenso['apellido_casada_esposa'] ?? ''])));
                            @endphp
                            <tr>
                                <td>{{ $censos->firstItem() + $loop->index }}</td>
                                <td>{{ $nombreEsposo !== '' ? $nombreEsposo : 'No registrado' }}</td>
                                <td>{{ $apellidoEsposo !== '' ? $apellidoEsposo : 'No registrado' }}</td>
                                <td>{{ $nombreEsposa !== '' ? $nombreEsposa : 'No registrado' }}</td>
                                <td>{{ $apellidoEsposa !== '' ? $apellidoEsposa : 'No registrado' }}</td>
                                <td>{{ $censo->comunidad }}</td>
                                <td>{{ $censo->direccion }}</td>
                                <td>{{ $censo->fecha_censo }}</td>
                                @foreach($columnasExtra as $campoExtra => $etiqueta)
                                <td>{{ $datosCenso[$campoExtra] ?? 'No registrado' }}</td>
                                @endforeach
                                <td>
                                    <div class="acciones-censo">
                                        <a href="{{ route('censos.edit', $censo->id) }}" class="btn btn-editar">Editar</a>
                                        <a href="{{ route('reportes.dpi', $censo->id) }}" class="btn btn-dpi">Ver DPI</a>
                                        <form action="{{ route('reportes.destroy', $censo->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar el censo No. {{ $censo->id }}? Esta acción no se puede deshacer.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-eliminar">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="{{ 9 + count($columnasExtra) }}" class="sin-registros">No se encontraron censos registrados.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- PAGINACIÓN -->
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
                                <a href="{{ $censos->previousPageUrl() }}">
                                    Anterior
                                </a>
                            @endif
                            <span class="actual">
                                Página {{ $censos->currentPage() }}
                            </span>
                            @if($censos->hasMorePages())
                                <a href="{{ $censos->nextPageUrl() }}">
                                    Siguiente
                                </a>
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
    const camposPorTipo = @json($camposPorTipo);
    const opcionesFiltros = @json($opcionesFiltros);
    const campoSeleccionado = @json(request('campo', ''));
    const valorSeleccionado = @json(request('valor', ''));
    function actualizarValoresReporte(seleccionInicial = false) {
        const tipo = document.getElementById('tipo_reporte').value;
        const campo = document.getElementById('campo').value;
        const select = document.getElementById('valor');
        select.innerHTML = '';
        select.add(new Option('Todos los valores registrados', ''));
        (opcionesFiltros[tipo]?.[campo] || []).forEach(valor => select.add(new Option(valor, valor)));
        if (seleccionInicial) select.value = valorSeleccionado;
    }
    function actualizarFiltrosReporte(seleccionInicial = false) {
        const tipo = document.getElementById('tipo_reporte').value;
        const esComunidad = tipo === 'comunidad';
        const tieneCriterios = !!camposPorTipo[tipo];
        const contenedorComunidad = document.getElementById('campo-comunidad');
        const comunidad = document.getElementById('comunidad');
        const contenedorCriterio = document.getElementById('campo-criterio');
        const contenedorValor = document.getElementById('campo-valor');
        const campo = document.getElementById('campo');
        contenedorComunidad.style.display = esComunidad ? '' : 'none';
        comunidad.disabled = !esComunidad;
        comunidad.required = esComunidad;
        contenedorCriterio.style.display = tieneCriterios ? '' : 'none';
        contenedorValor.style.display = tieneCriterios ? '' : 'none';
        campo.disabled = !tieneCriterios;
        document.getElementById('valor').disabled = !tieneCriterios;
        campo.innerHTML = '';
        if (tieneCriterios) {
            Object.entries(camposPorTipo[tipo]).forEach(([clave, etiqueta]) => campo.add(new Option(etiqueta, clave)));
            if (seleccionInicial && camposPorTipo[tipo][campoSeleccionado]) campo.value = campoSeleccionado;
            actualizarValoresReporte(seleccionInicial);
        }
    }
    document.getElementById('campo').addEventListener('change', () => actualizarValoresReporte());
    function exportarReporte(formato) {
        const formulario = document.getElementById('formulario-reportes');
        if (!formulario.reportValidity()) return;
        const parametros = new URLSearchParams(new FormData(formulario));
        parametros.delete('page');
        const busqueda = new URLSearchParams(window.location.search).get('buscar');
        if (busqueda) parametros.set('buscar', busqueda);
        const ruta = formato === 'pdf'
            ? @json(route('reportes.exportar.pdf'))
            : @json(route('reportes.exportar.excel'));
        window.location.href = ruta + '?' + parametros.toString();
    }
    document.addEventListener('DOMContentLoaded', () => actualizarFiltrosReporte(true));
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
        if (event.key === 'Escape') {
            cerrarMenu();
        }
    });
</script>
</body>
</html>
```
````
