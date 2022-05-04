# API REST con PHP
> API REST desarrollada en PHP con funcionalidad básica CRUD para manipular una base de datos con lenguajes que almacena herramientas de programación.
## Instalación
Para hacer uso de esta aplicación tan solo debes clonar el repositorio en tu máquina y copiar el script del archivo database.sql una base de datos MySQL.
## Configuración
Completa las siguientes líneas de código con tu información.

En `Database.php`:
```
private $host = 'XXXX';
private $db_name = 'XXXX';
private $db_user = 'XXXX';
private $db_password = 'XXXX';
 ```
 - **$host** = host de tu base de datos, generalmente 'localhost'
 - **$db_name** = nombre de tu base de datos
 - **$db_user** = nombre de usuario de tu base de datos
 - **$db_password** = contraseña de tu usuario

En `parameters.php`:
```
define('base_url', 'XXXX');
define('base_api_posts', 'http://localhost/php-api-rest/api/post/');
```
- **base_url** = URL de tu proyecto
- **base_api_posts** = URL del directorio donde se almacenan los archivos de la API para manipular los posts de la base de datos
## Modo de uso
Las operaciones que se pueden realizar con esta API se enmarcan dentro de las siglas CRUD:
- **C**: Create (token requerido)
- **R**: Read
- **U**: Update (token requerido)
- **D**: Delete (token requerido)

Para conseguir un token válido para ejecutar las consultas, es necesario registrarse en la aplicación.

### Ver POSTs (Read)

```
method: 'GET',
headers: {
  Content-Type': 'application/json'
}
URL: http://localhost/php-api-rest/api/post/posts.php
```

### Ver un POST concreto (Read)

```
method: 'GET',
headers: {
  Content-Type': 'application/json'
}
URL: http://localhost/php-api-rest/api/post/posts.php?id=:id
```

### Crear un POST (Create)

```
method: 'POST',
headers: {
  Content-Type': 'application/json'
},
body: {
  "title": "Spring Boot...",
  "body": "Spring Boot is an open source, microservice-based Java web...",
  "author": "VMware",
  "category_id": 2,
   "token": "YOUR-TOKEN"
}
URL: http://localhost/php-api-rest/api/post/create.php
```
### Actualizar un POST (Update)

```
method: 'PUT',
headers: {
  Content-Type': 'application/json'
},
body: {
  "id": 4,
  "title": "Spring Boot...",
  "body": "Spring Boot is an open source, microservice-based Java web...",
  "author": "VMware",
  "category_id": 2,
   "token": "YOUR-TOKEN"
}
URL: http://localhost/php-api-rest/api/post/update.php
```
### Eliminar un POST (Delete)

```
method: 'DELETE',
headers: {
  Content-Type': 'application/json'
},
body: {
  "id": 2,
   "token": "YOUR-TOKEN"
}
URL: http://localhost/php-api-rest/api/post/delete.php
```

