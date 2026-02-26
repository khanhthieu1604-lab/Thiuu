# 🛑 Docker Deployment - Stop All Projects
Write-Host "Stopping Thiuu CarRental + KThiuu Hotel Docker Containers..." -ForegroundColor Cyan

# Thiuu CarRental
Write-Host "`n📦 Stopping Thiuu CarRental..." -ForegroundColor Yellow
Set-Location "d:\Thiuu\Thiuu"
docker-compose down
if ($LASTEXITCODE -eq 0) {
    Write-Host "✅ Thiuu CarRental stopped successfully!" -ForegroundColor Green
}
else {
    Write-Host "❌ Failed to stop Thiuu CarRental" -ForegroundColor Red
}

# KThiuu Hotel
Write-Host "`n📦 Stopping KThiuu Hotel..." -ForegroundColor Yellow
Set-Location "d:\Thiuu\KThiuu_Hotel"
docker-compose down
if ($LASTEXITCODE -eq 0) {
    Write-Host "✅ KThiuu Hotel stopped successfully!" -ForegroundColor Green
}
else {
    Write-Host "❌ Failed to stop KThiuu Hotel" -ForegroundColor Red
}

Write-Host "`n✨ All projects stopped!" -ForegroundColor Cyan

Set-Location "d:\Thiuu"
