# EVA 3 - API RESTful ProviEmplea

Este proyecto corresponde a la evaluación final de Backend.  
La API fue desarrollada utilizando Laravel, MySQL y Docker siguiendo una arquitectura RESTful.

---

## Tecnologías utilizadas

- Laravel
- PHP
- MySQL
- Docker Desktop
- Swagger (OpenAPI 3.0)

---

## Objetivo del proyecto

El objetivo de este proyecto es desarrollar una API RESTful que permita gestionar un sistema de empleabilidad, donde se administran personas, empresas y contactos solicitados entre ambas entidades.

La API permite registrar personas, registrar empresas, crear contactos entre personas y empresas, consultar registros mediante endpoints REST, actualizar y eliminar registros, y documentar la API mediante Swagger.

---

## Arquitectura del sistema

El sistema funciona de la siguiente forma:

El cliente realiza una petición HTTP, la solicitud llega a Laravel a través de las rutas definidas en api.php, la ruta dirige la petición al controlador correspondiente, el controlador ejecuta la lógica del negocio, el modelo interactúa con la base de datos MySQL mediante Eloquent y finalmente Laravel devuelve una respuesta en formato JSON al cliente.

---

## Persistencia de datos

La persistencia de datos se implementó utilizando migraciones de Laravel y MySQL.

Se crearon las tablas personas, empresas y contacto_solicitados.

La tabla personas contiene información de los candidatos como id, email, telefono, codigo_talento, resumen, created_at y updated_at.  

La tabla empresas contiene información de las empresas como id, nombre_empresa, rut_empresa, email, rubro, tipo_empresa, contacto_nombre, contacto_email, contacto_telefono, created_at y updated_at.  

La tabla contacto_solicitados registra la relación entre personas y empresas con campos como id, empresa_id, persona_id, estado, notas_admin, fecha_contacto, fecha_entrevista, fecha_resultado, created_at y updated_at.

---

## Configuración del proyecto

Para ejecutar el proyecto primero se deben levantar los contenedores utilizando docker compose up -d, luego instalar las dependencias del proyecto con composer install, después ejecutar las migraciones con php artisan migrate y en caso de problemas limpiar caché con php artisan optimize:clear.

---

## Endpoints disponibles

### Personas

GET /api/personas  
POST /api/personas  
GET /api/personas/{id}  
PUT /api/personas/{id}  
DELETE /api/personas/{id}

### Empresas

GET /api/empresas  
POST /api/empresas  
GET /api/empresas/{id}  
PUT /api/empresas/{id}  
DELETE /api/empresas/{id}

### Contactos solicitados

GET /api/contactos  
POST /api/contactos  
GET /api/contactos/{id}  
PUT /api/contactos/{id}  
DELETE /api/contactos/{id}

---

## Validaciones implementadas

La API valida los campos de personas, empresas y contactos solicitados asegurando que los datos obligatorios estén presentes, que los correos electrónicos y códigos sean únicos y que las relaciones entre tablas existan en la base de datos.

---

## Documentación Swagger

La documentación de la API está disponible en http://localhost:8080/api/documentation y el archivo swagger.yaml se encuentra en la raíz del proyecto.

---

## Herramientas utilizadas para pruebas

Se utilizó el entorno de Swagger UI para probar y validar los endpoints de la API, junto con MySQL para la verificación de la persistencia de datos.

---

## Integrantes

- Alvaro Vasquez Bernales

---

## Link Repositorio

https://github.com/nekmo2/proviemplea_eva3
