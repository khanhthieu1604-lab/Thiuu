# 🚀 Run Both Projects Locally (Simple Development)

Write-Host "Starting Thiuu + KThiuu_Hotel Local Servers..." -ForegroundColor Cyan

# Thiuu CarRental (Port 8000)
Write-Host "`n📦 Starting Thiuu CarRental on http://localhost:8000..." -ForegroundColor Yellow
Start-Process pwsh -ArgumentList "-NoExit", "-Command", "cd d:\Thiuu\Thiuu; php artisan serve --port=8000"

Start-Sleep -Seconds 2

# KThiuu Hotel (Port 8001)  
Write-Host "📦 Starting KThiuu Hotel on http://localhost:8001..." -ForegroundColor Yellow
Start-Process pwsh -ArgumentList "-NoExit", "-Command", "cd d:\Thiuu\KThiuu_Hotel; php artisan serve --port=8001"

Start-Sleep -Seconds 2

Write-Host "`n✅ Both projects started!" -ForegroundColor Green
Write-Host "`n🌐 Access:" -ForegroundColor Cyan
Write-Host "   Thiuu CarRental: http://localhost:8000" -ForegroundColor White
Write-Host "   KThiuu Hotel:    http://localhost:8001" -ForegroundColor White
Write-Host "`n💡 Press Ctrl+C in each terminal to stop servers" -ForegroundColor Yellow
