# 🚀 Docker Deployment - Start All Projects
Write-Host "Starting Thiuu CarRental + KThiuu Hotel Docker Containers..." -ForegroundColor Cyan

# Thiuu CarRental
Write-Host "`n📦 Starting Thiuu CarRental..." -ForegroundColor Yellow
Set-Location "d:\Thiuu\Thiuu"

if (-not (Test-Path ".env.docker")) {
    Write-Host "Creating .env.docker from example..." -ForegroundColor Green
    Copy-Item ".env.docker.example" ".env.docker"
}

docker-compose up -d
if ($LASTEXITCODE -eq 0) {
    Write-Host "✅ Thiuu CarRental started successfully!" -ForegroundColor Green
    Write-Host "   🌐 Application: http://localhost:8080" -ForegroundColor White
    Write-Host "   🗄️  phpMyAdmin: http://localhost:8089" -ForegroundColor White
    Write-Host "   📧 Mailhog: http://localhost:8025" -ForegroundColor White
} else {
    Write-Host "❌ Thiuu CarRental failed to start" -ForegroundColor Red
}

# KThiuu Hotel
Write-Host "`n📦 Starting KThiuu Hotel..." -ForegroundColor Yellow
Set-Location "d:\Thiuu\KThiuu_Hotel"

if (-not (Test-Path ".env.docker")) {
    Write-Host "Creating .env.docker from example..." -ForegroundColor Green
    Copy-Item ".env.docker.example" ".env.docker"
}

docker-compose up -d
if ($LASTEXITCODE -eq 0) {
    Write-Host "✅ KThiuu Hotel started successfully!" -ForegroundColor Green
    Write-Host "   🌐 Application: http://localhost:8081" -ForegroundColor White
    Write-Host "   🗄️  phpMyAdmin: http://localhost:8090" -ForegroundColor White
    Write-Host "   📧 Mailhog: http://localhost:8026" -ForegroundColor White
} else {
    Write-Host "❌ KThiuu Hotel failed to start" -ForegroundColor Red
}

Write-Host "`n✨ All projects started!" -ForegroundColor Cyan
Write-Host "`nFirst time setup? Run these commands:" -ForegroundColor Yellow
Write-Host "  cd d:\Thiuu\Thiuu && docker-compose exec app php artisan key:generate" -ForegroundColor White
Write-Host "  cd d:\Thiuu\Thiuu && docker-compose exec app php artisan migrate --seed" -ForegroundColor White
Write-Host "  cd d:\Thiuu\KThiuu_Hotel && docker-compose exec app php artisan key:generate" -ForegroundColor White
Write-Host "  cd d:\Thiuu\KThiuu_Hotel && docker-compose exec app php artisan migrate --seed" -ForegroundColor White

Set-Location "d:\Thiuu"
