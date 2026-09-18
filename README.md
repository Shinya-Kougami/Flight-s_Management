Sistema de Gestión de Reservas de Vuelos - AETHER

## Descripción del Proyecto
AETHER es un sistema web de reservas de vuelos premium desarrollado bajo una Arquitectura Orientada a Servicios (SOA). El sistema permite a los usuarios registrarse, buscar vuelos disponibles, realizar reservas y gestionar su historial de compras. 

El proyecto está empaquetado utilizando **Docker** como Plataforma como Servicio (PaaS), orquestando dos contenedores principales: un servidor web (Apache + PHP) y un motor de base de datos (MySQL).

### Tecnologías Utilizadas
* **Frontend:** HTML5, CSS3 (Flexbox, Animaciones CSS).
* **Backend:** PHP 8.2 (Autenticación con sesiones y contraseñas cifradas).
* **Base de Datos:** MySQL 8.0 (PDO para consultas preparadas).
* **Infraestructura:** Docker y Docker Compose.

---

## Configuración y Despliegue

Sigue estos pasos para desplegar la aplicación en cualquier entorno local utilizando contenedores:

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/Shinya-Kougami/Flight-s_Management
   cd sistema-vueloslight-s_Management
   Levantar la infraestructura con Docker Compose:
   
2. **Ejecutar Docker compose**
   
Ejecuta el siguiente comando en la raíz del proyecto para construir la imagen de PHP e iniciar la base de datos MySQL en segundo plano. 
El script db/init.sql creará automáticamente las tablas y los vuelos de prueba.

docker-compose up -d --build

3. **Verificar que los servicios web y sql esten desplegados**

docker ps

4. **Acceder a la aplicacion web**

Abre un navegador web y navega a: http://localhost:8080/search.html
