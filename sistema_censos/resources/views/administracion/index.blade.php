
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración | Aplicación Web Censal</title>

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

        /* CONTENIDO */

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

        /* FORMULARIOS */

        .formulario {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .campo label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .campo input,
        .campo select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 14px;
        }

        .acciones-formulario {
            grid-column: 1 / -1;
        }

        .boton {
            border: none;
            border-radius: 7px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 13px;
        }

        .primario {
            background: #12335b;
            color: white;
        }

        .secundario {
            background: #e2e8f0;
            color: #12335b;
        }

        .peligro {
            background: #fee2e2;
            color: #991b1b;
        }

        /* TABLA DE USUARIOS */

        .tabla-contenedor {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        th {
            background: #f8fafc;
            color: #12335b;
        }

        .acciones {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .acciones form {
            display: inline;
        }

        .estado {
            font-weight: bold;
        }

        .activo {
            color: #166534;
        }

        .inactivo {
            color: #991b1b;
        }

        .menu a.activo {
            color: white;
        }

        /* MENSAJES */

        .mensaje {
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .exito {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* MENÚ MÓVIL */

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
                transition: transform .25s ease;
            }

            body.menu-movil-abierto .sidebar {
                transform: translateX(0);
            }

            body.menu-movil-abierto .fondo-menu-movil {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, .55);
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

            .formulario {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

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
        <a href="{{ route('reportes.index') }}">
            Reportes
        </a>
        @endcan

        <a href="{{ route('informacion.index') }}">
            Información
        </a>

        @can('administrar-sistema')
        <a href="{{ route('administracion.index') }}"
           class="activo"
           aria-current="page">
            Administración
        </a>
        @endcan

    </nav>

</aside>

<!-- FONDO DEL MENÚ MÓVIL -->

<div class="fondo-menu-movil" id="fondo-menu-movil"></div>

<!-- CONTENIDO PRINCIPAL -->

<main class="principal">

    <header class="barra-superior">

        <div class="titulo-barra">

            <button type="button"
                    class="boton-menu-movil"
                    id="boton-menu-movil"
                    aria-label="Abrir menú"
                    aria-expanded="false"
                    aria-controls="menu-lateral">
                ☰
            </button>

            <h1>Administración</h1>

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

            <h2>Administración de usuarios</h2>

            <p>
                Registre usuarios, asigne permisos y gestione
                el acceso al sistema censal.
            </p>

        </div>

        <!-- MENSAJES -->

        @if(session('success'))
            <div class="mensaje exito">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mensaje error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())

            <div class="mensaje error">

                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif

        <!-- REGISTRAR NUEVO USUARIO -->

        <section class="tarjeta">

            <h3>Registrar nuevo usuario</h3>

            <form action="{{ route('administracion.store') }}"
                  method="POST"
                  class="formulario">

                @csrf

                <div class="campo">
                    <label for="name">Nombre completo</label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           maxlength="255">
                </div>

                <div class="campo">
                    <label for="email">Correo electrónico</label>

                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           maxlength="255">
                </div>

                <div class="campo">
                    <label for="password">Contraseña</label>

                    <input type="password"
                           id="password"
                           name="password"
                           required
                           minlength="8">
                </div>

                <div class="campo">
                    <label for="password_confirmation">
                        Confirmar contraseña
                    </label>

                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           required
                           minlength="8">
                </div>

                <div class="campo">
                    <label for="rol">Rol del usuario</label>

                    <select id="rol" name="rol" required>

                        <option value="usuario"
                            {{ old('rol') === 'usuario' ? 'selected' : '' }}>
                            Usuario normal
                        </option>

                        <option value="administrador"
                            {{ old('rol') === 'administrador' ? 'selected' : '' }}>
                            Administrador
                        </option>

                    </select>
                </div>

                <div class="acciones-formulario">
                    <button type="submit" class="boton primario">
                        Registrar usuario
                    </button>
                </div>

            </form>

        </section>

        <!-- USUARIOS REGISTRADOS -->

        <section class="tarjeta">

            <h3>Usuarios registrados</h3>

            <div class="tabla-contenedor">

                <table>

                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($usuarios as $usuario)

                        <tr>

                            <td>{{ $usuario->name }}</td>

                            <td>{{ $usuario->email }}</td>

                            <td>
                                {{ $usuario->rol === 'administrador' ? 'Administrador' : 'Usuario normal' }}
                            </td>

                            <td>
                                <span class="estado {{ $usuario->activo ? 'activo' : 'inactivo' }}">
                                    {{ $usuario->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>

                            <td>

                                <div class="acciones">

                                    <button type="button"
                                            class="boton secundario"
                                            onclick="mostrarEdicion({{ $usuario->id }})">
                                        Editar
                                    </button>

                                    <form action="{{ route('administracion.estado', $usuario->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="boton secundario">
                                            {{ $usuario->activo ? 'Desactivar' : 'Activar' }}
                                        </button>

                                    </form>

                                    <form action="{{ route('administracion.destroy', $usuario->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Está seguro de eliminar este usuario?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="boton peligro">
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        <!-- FORMULARIO DE EDICIÓN -->

                        <tr id="editar-{{ $usuario->id }}"
                            style="display:none;">

                            <td colspan="5">

                                <form action="{{ route('administracion.update', $usuario->id) }}"
                                      method="POST"
                                      class="formulario">

                                    @csrf
                                    @method('PUT')

                                    <div class="campo">
                                        <label>Nombre completo</label>

                                        <input type="text"
                                               name="name"
                                               value="{{ $usuario->name }}"
                                               required>
                                    </div>

                                    <div class="campo">
                                        <label>Correo electrónico</label>

                                        <input type="email"
                                               name="email"
                                               value="{{ $usuario->email }}"
                                               required>
                                    </div>

                                    <div class="campo">
                                        <label>Rol</label>

                                        <select name="rol" required>

                                            <option value="usuario"
                                                {{ $usuario->rol === 'usuario' ? 'selected' : '' }}>
                                                Usuario normal
                                            </option>

                                            <option value="administrador"
                                                {{ $usuario->rol === 'administrador' ? 'selected' : '' }}>
                                                Administrador
                                            </option>

                                        </select>
                                    </div>

                                    <div class="campo">
                                        <label>Nueva contraseña (opcional)</label>

                                        <input type="password"
                                               name="password"
                                               minlength="8">
                                    </div>

                                    <div class="campo">
                                        <label>Confirmar nueva contraseña</label>

                                        <input type="password"
                                               name="password_confirmation"
                                               minlength="8">
                                    </div>

                                    <div class="acciones-formulario">

                                        <button type="submit" class="boton primario">
                                            Guardar cambios
                                        </button>

                                        <button type="button"
                                                class="boton secundario"
                                                onclick="mostrarEdicion({{ $usuario->id }})">
                                            Cancelar
                                        </button>

                                    </div>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">
                                No hay usuarios registrados.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </div>

</main>

<script>

    /* MOSTRAR Y OCULTAR EDICIÓN */

    function mostrarEdicion(id) {

        const fila = document.getElementById('editar-' + id);

        if (!fila) return;

        fila.style.display =
            fila.style.display === 'none'
                ? 'table-row'
                : 'none';
    }

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
