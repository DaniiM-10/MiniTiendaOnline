# Mini Tienda Online

Proyectode practica simple sobre tienda online, en PHP utilizando el patrón MVC.

---

## Estructura del Proyecto

├── app/ 

│ │ │ ├── Controllers/

│ │ │ ├── Models/

│ │ │ └── Views/

├── Core/ 
│ │ │ ├── Logger.php
│ │ │ └── Router.php  
├── db/ 
│ │ │ ├── minitiendaonline.sql 
│ │ │ └── diagramas/
├── logs/
│ │ │ └── app.log 
├── Public/ 
│ │ │ ├── assets/Productos/
│ │ │ ├── .htaccess **(DEBE INCLUIRLO)**
│ │ │ └── index.php 
├── config.php 
├── composer.json 
├── .env (DEBE INCLUIRLO) 
└── .htaccess (DEBE INCLUIRLO)


## Instalar las dependencias con Composer:
```bash
composer install
```

## Base de datos:
En la carpeta ***db/*** esta la base de datos junto con los diagramas para conocer su estructura.

## Configuración del archivo `.env`

El archivo `.env` contiene las variables de configuración para la conexion a la base de datos y otros parámetros importantes. Debe crear un archivo `.env` en la raíz del proyecto con el siguiente contenido:

```env
DB_HOST=localhost
DB_NAME=MiniTiendaOnline
DB_USER=root
DB_PASSWORD=
DB_PORT=3306
DB_CHARSET=utf8mb4
```

## Configuración de los archivos `.htaccess` (son 2 archivos)

**1.** Archivo .htaccess en la **raíz del proyecto**: Este archivo redirige todas las solicitudes a la carpeta Public para que el acceso a los archivos sea más seguro.

```htaccess
RewriteEngine On
RewriteRule ^$ Public/ [L]
RewriteRule ^(.*)$ Public/$1 [L]
```

**2.** Archivo .htaccess dentro de la carpeta **Public**:

Este archivo redirige las solicitudes que no corresponden a archivos existentes o directorios a index.php, que es el punto de entrada principal dela web.
```htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
```
