# 🚀 Docker Deployment Scripts - Thiuu Projects

## Quick Start

### Start All Projects
```powershell
.\docker-start-all.ps1
```

### Stop All Projects
```powershell
.\docker-stop-all.ps1
```

---

## Individual Project Commands

### Thiuu CarRental (Port 8080)
```powershell
cd d:\Thiuu\Thiuu
docker-compose up -d
```

**Access:**
- **Application:** http://localhost:8080
- **phpMyAdmin:** http://localhost:8089
- **Mailhog:** http://localhost:8025

---

### KThiuu Hotel (Port 8081)
```powershell
cd d:\Thiuu\KThiuu_Hotel
docker-compose up -d
```

**Access:**
- **Application:** http://localhost:8081
- **phpMyAdmin:** http://localhost:8090
- **Mailhog:** http://localhost:8026

---

## First Time Setup

### 1. Copy Environment Files
```powershell
# Thiuu
cd d:\Thiuu\Thiuu
Copy-Item .env.docker.example .env.docker

# KThiuu_Hotel
cd d:\Thiuu\KThiuu_Hotel
Copy-Item .env.docker.example .env.docker
```

### 2. Generate Application Keys
```powershell
# Thiuu
docker-compose exec app php artisan key:generate

# KThiuu
docker-compose exec app php artisan key:generate
```

### 3. Run Migrations
```powershell
# Thiuu
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force

# KThiuu
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force
```

### 4. Optimize for Production
```powershell
# Thiuu
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

# KThiuu
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

---

## Maintenance Commands

### View Logs
```powershell
# Thiuu
docker-compose logs -f app

# KThiuu
docker-compose logs -f app
```

### Restart Services
```powershell
docker-compose restart
```

### Rebuild Images
```powershell
docker-compose build --no-cache
docker-compose up -d
```

### Clear Cache
```powershell
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

---

## Database Access

### MySQL (via phpMyAdmin)
- **Thiuu:** http://localhost:8089
- **KThiuu:** http://localhost:8090
- **Username:** root
- **Password:** password

### MySQL (via CLI)
```powershell
# Thiuu
docker-compose exec mysql mysql -u root -ppassword laravel

# KThiuu
docker-compose exec mysql mysql -u root -ppassword kthiuu_hotel
```

---

## Port Mappings

| Service | Thiuu | KThiuu |
|---------|-------|--------|
| **Web App** | 8080 | 8081 |
| **MySQL** | 3306 | 3307 |
| **Redis** | 6379 | 6380 |
| **phpMyAdmin** | 8089 | 8090 |
| **Mailhog SMTP** | 1025 | 1026 |
| **Mailhog UI** | 8025 | 8026 |

---

## Troubleshooting

### Port Already in Use
```powershell
# Check what's using the port
netstat -ano | findstr :8080

# Kill the process
taskkill /PID <PID> /F
```

### Permission Errors
```powershell
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### Database Connection Failed
```powershell
# Restart MySQL
docker-compose restart mysql

# Check MySQL is healthy
docker-compose ps mysql
```

---

## Production Deployment

For production deployment, see [`production_deployment_guide.md`](./production_deployment_guide.md)
