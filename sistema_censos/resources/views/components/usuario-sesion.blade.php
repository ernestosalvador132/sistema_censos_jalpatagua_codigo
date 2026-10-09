
<div class="usuario-sesion">
    <strong>{{ auth()->user()->name }}</strong>

    <span>
        {{ auth()->user()->esAdministrador() ? 'Administrador' : 'Usuario' }}
    </span>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-cerrar-sesion">
            Cerrar sesión
        </button>
    </form>
</div>

<style>
.usuario-sesion {
    text-align: right;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 5px;
}

.usuario-sesion strong {
    font-size: 14px;
    color: #1f2937;
}

.usuario-sesion span {
    font-size: 12px;
    color: #6b7280;
}

.usuario-sesion form {
    margin: 0;
}

.btn-cerrar-sesion {
    background: transparent;
    border: none;
    color: #dc2626;
    font-size: 12px;
    font-weight: bold;
    cursor: pointer;
    padding: 4px 0;
}

.btn-cerrar-sesion:hover {
    text-decoration: underline;
}

@media (max-width: 800px) {
    .usuario-sesion strong {
        font-size: 12px;
    }

    .usuario-sesion span,
    .btn-cerrar-sesion {
        font-size: 11px;
    }
}
</style>
