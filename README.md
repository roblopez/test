Test Symfony 2.7
========================

Aplicación con control de acceso de usuarios que permite completar los datos personales del usuario y obtener un hash.

Clonar repositorio
-----------------------
git clone https://github.com/roblopez/test.git

Actualizar dependencias
-----------------------
php composer.phar update

Crear bdd (opcional)
-----------------------
php app/console doctrine:database:create

Sincronizar base de datos (update tablas y estructuras)
-----------------------
php app/console doctrine:schema:update --force

Crear usuario para acceder al formulario de insercción de datos.
-----------------------
php app/console fos:user:create

Para acceder al entorno de desarrollo (Recomendable apuntar directamente a este archivo para ejecutar la aplicación).
-----------------------
localhost/app_dev.php



