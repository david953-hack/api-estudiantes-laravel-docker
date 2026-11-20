# API de Estudiantes – Laravel, MySQL y Docker

## 1. Descripción del proyecto

Este proyecto consiste en el desarrollo de una API REST para la gestión de estudiantes, utilizando Laravel como framework de desarrollo, MySQL como sistema de gestión de bases de datos y Docker para la configuración y ejecución de los servicios.

La API permite registrar estudiantes, consultar todos los registros, buscar estudiantes por su identificador y validar que no existan correos electrónicos duplicados.

## 2. Tecnologías utilizadas

- **Laravel 13:** desarrollo de la API REST.
- **PHP 8.4:** lenguaje de programación.
- **MySQL 8.4:** almacenamiento de información.
- **Docker:** ejecución de los contenedores.
- **Docker Compose:** administración de los servicios.

## 3. Estructura de Docker

El proyecto utiliza dos servicios principales:

- **app:** contiene la aplicación Laravel y ejecuta el servidor en el puerto 8000.
- **db:** contiene el servidor MySQL y almacena la información de los estudiantes.

La configuración de Docker Compose permite que ambos servicios se comuniquen dentro de una misma red.

### ¿Por qué se utiliza DB_HOST=db?

Se utiliza `DB_HOST=db` porque `db` es el nombre del servicio de MySQL definido en el archivo `docker-compose.yml`.

Docker Compose permite que los contenedores se comuniquen utilizando los nombres de sus servicios como nombres de host. Por esta razón, Laravel debe conectarse a `db` y no a `localhost`.

El puerto 3307 se utiliza para acceder a MySQL desde el equipo local, mientras que la comunicación entre los contenedores utiliza el puerto interno 3306.

## 4. Configuración de la base de datos

La conexión se configura mediante las siguientes variables de entorno:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=estudiantes_db
DB_USERNAME=laravel
DB_PASSWORD=laravel123
```

La tabla `estudiantes` contiene los siguientes campos:

| Campo | Descripción |
|---|---|
| id | Identificador único |
| nombre | Nombre del estudiante |
| correo | Correo electrónico único |
| programa | Programa académico |
| created_at | Fecha de creación |
| updated_at | Fecha de actualización |

## 5. Instalación y ejecución

Para ejecutar el proyecto se deben tener instalados Docker Desktop y Docker Compose.

1. Descargar o clonar el repositorio.
2. Configurar el archivo `.env` con las variables de conexión indicadas anteriormente.
3. Abrir una terminal en la carpeta principal del proyecto.
4. Construir y levantar los contenedores:

```bash
docker compose up --build -d
```

5. Generar la clave de Laravel, si es necesario:

```bash
docker compose exec app php artisan key:generate
```

6. Ejecutar las migraciones y cargar los datos iniciales:

```bash
docker compose exec app php artisan migrate --seed
```

7. Comprobar el estado de los contenedores:

```bash
docker compose ps
```

La aplicación estará disponible en:

`http://localhost:8000`

## 6. Endpoints de la API

| Método | Endpoint | Función |
|---|---|---|
| GET | `/api/health` | Verificar conexión con la base de datos |
| GET | `/api/estudiantes` | Consultar todos los estudiantes |
| POST | `/api/estudiantes` | Registrar un estudiante |
| GET | `/api/estudiantes/{id}` | Consultar un estudiante por ID |

### Ejemplo de registro de estudiante

Solicitud POST:

```json
{
    "nombre": "Maria Fernanda",
    "correo": "maria@example.com",
    "programa": "Ingenieria de Software"
}
```

Respuesta esperada:

- Código 201: estudiante registrado correctamente.
- Código 422: error de validación, por ejemplo, cuando el correo ya existe.
- Código 404: estudiante no encontrado.

## 7. Datos iniciales

El proyecto incluye un Seeder que registra cinco estudiantes de ejemplo al ejecutar las migraciones con `--seed`.

También se realizaron registros adicionales mediante el endpoint POST para comprobar el funcionamiento de la API.

## 8. Pruebas realizadas

Se realizaron las siguientes pruebas:

1. Verificación del estado de los contenedores mediante `docker compose ps`.
2. Comprobación de la conexión con MySQL mediante `/api/health`.
3. Consulta de todos los estudiantes.
4. Registro de un nuevo estudiante mediante POST.
5. Validación para evitar correos electrónicos duplicados.
6. Consulta de un estudiante por su identificador.
7. Comprobación de la respuesta 404 cuando el estudiante no existe.

Las pruebas permitieron verificar el funcionamiento de la aplicación, la comunicación entre Laravel y MySQL y las operaciones principales de la API.

## 9. Conclusión

El desarrollo de este proyecto permitió implementar una API REST utilizando Laravel, MySQL y Docker. Se logró configurar los servicios mediante Docker Compose, establecer la conexión entre los contenedores y desarrollar las operaciones de consulta y registro de estudiantes.

Además, se implementaron validaciones para evitar registros duplicados y respuestas adecuadas para los diferentes escenarios de consulta. Con esto se comprobó el funcionamiento de la aplicación dentro de un entorno de contenedores.