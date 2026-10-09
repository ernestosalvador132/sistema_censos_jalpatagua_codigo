# Sistema de Censos - Municipalidad de Jalpatagua, Jutiapa

Proyecto base Laravel para el sistema diseñado para Ernesto Salvador.

## Módulos
1. Inicio de sesión
2. Inicio
3. Registro censal
4. Reportes (general / MAGA / VISAN / SESAN / Municipalidad + Excel)
5. Información (comunidades y COCODE)
6. Administración de usuarios (Administrador y Digitador)

## Instalación
1. Crear un proyecto Laravel nuevo: `composer create-project laravel/laravel sistema-censos`
2. Copiar el contenido de esta carpeta sobre el proyecto.
3. Configurar `.env` con MySQL.
4. Ejecutar `php artisan migrate --seed`.
5. Ejecutar `php artisan serve`.

## Usuario inicial
- Correo: admin@jalpatagua.gob.gt
- Contraseña: Admin12345!

Cambie la contraseña después de iniciar sesión.

Las imágenes entregadas por el usuario están en `public/images/`.
