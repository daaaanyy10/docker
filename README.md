# Stack Docker - Nginx + PHP + MySQL + phpMyAdmin

Stack de contenedores para desarrollo local con Nginx, PHP-FPM, MySQL y phpMyAdmin.

## Estructura

```
.
├── docker-compose.yml
├── .env
├── README.md
├── nginx/
│   └── default.conf
├── php/
│   └── Dockerfile
└── src/
    └── index.php
```

## Servicios

- **Nginx** (puerto 8080) - Servidor web
- **PHP-FPM** - Procesador PHP
- **MySQL** (puerto 3306) - Base de datos
- **phpMyAdmin** (puerto 8081) - Gestor de BD

## Inicio rápido

```bash
cd C:\docker
docker compose up -d
```

Luego accede a:
- http://localhost:8080 - Tu aplicación
- http://localhost:8081 - phpMyAdmin
- localhost:3306 - MySQL

## Credenciales MySQL

```
Usuario: admin
Contraseña: admin_password
Base de datos: myapp_db
```

Para phpMyAdmin usa las mismas credenciales.

## Comandos útiles

```bash
# Ver estado de contenedores
docker compose ps

# Ver logs
docker compose logs -f nginx

# Ejecutar comando en contenedor
docker compose exec php php -v

# Detener
docker compose down

# Detener y borrar datos
docker compose down -v
```

## Desarrollo

Los archivos PHP están en `src/` y se replican en vivo en el contenedor. Solo refrescar el navegador para ver cambios.

## Conectar desde PHP a MySQL

```php
$pdo = new PDO(
    'mysql:host=mysql;dbname=myapp_db',
    'admin',
    'admin_password'
);
```

El hostname es `mysql` (nombre del servicio en la red Docker).

## Solución de problemas

**Puerto 8080 en uso:**
```bash
netstat -ano | findstr :8080
```

**MySQL no inicia:**
```bash
docker compose logs mysql
```

**Cambios PHP no se reflejan:**
- Verificar que `src/` esté mapeado en el compose
- Refrescar navegador (Ctrl+F5)
