$ErrorActionPreference = "Stop"

function Assert-Command($cmd, $hint) {
  if (-not (Get-Command $cmd -ErrorAction SilentlyContinue)) {
    Write-Host ""
    Write-Host "Missing: $cmd" -ForegroundColor Red
    Write-Host $hint -ForegroundColor Yellow
    exit 1
  }
}

Write-Host "=== SheStitch Auto Setup (Laravel 10 + Breeze + Chat) ===" -ForegroundColor Cyan

Assert-Command php "Install PHP 8.1+ (XAMPP PHP is fine) and add it to PATH."
Assert-Command composer "Install Composer then reopen terminal."
Assert-Command node "Install Node.js LTS then reopen terminal."
Assert-Command npm "npm comes with Node.js."

$root = Split-Path -Parent $MyInvocation.MyCommand.Path
$target = Join-Path $root "SheStitch"

if (Test-Path $target) {
  Write-Host "Folder already exists: $target" -ForegroundColor Yellow
  Write-Host "Delete it if you want a fresh install." -ForegroundColor Yellow
  exit 1
}

Write-Host "1) Creating Laravel 10 project..." -ForegroundColor Green
Set-Location $root
composer create-project laravel/laravel "SheStitch" "^10.0"

Write-Host "2) Installing Laravel Breeze..." -ForegroundColor Green
Set-Location $target
composer require laravel/breeze --dev
php artisan breeze:install blade

Write-Host "3) Copying SheStitch code overlay..." -ForegroundColor Green
Set-Location $root

# Copy our prepared app code into Laravel project
robocopy (Join-Path $root "app") (Join-Path $target "app") /E
robocopy (Join-Path $root "routes") (Join-Path $target "routes") /E
robocopy (Join-Path $root "resources") (Join-Path $target "resources") /E
robocopy (Join-Path $root "database") (Join-Path $target "database") /E
robocopy (Join-Path $root "public") (Join-Path $target "public") /E

Copy-Item (Join-Path $root ".env.example") (Join-Path $target ".env.example") -Force

Write-Host "4) Installing frontend deps + building..." -ForegroundColor Green
Set-Location $target
npm install
npm run build

Write-Host "5) Creating storage symlink..." -ForegroundColor Green
php artisan storage:link

Write-Host ""
Write-Host "DONE. Next steps:" -ForegroundColor Cyan
Write-Host "A) Create MySQL DB: shestitch (phpMyAdmin)" -ForegroundColor White
Write-Host "B) Copy .env.example to .env and set DB_DATABASE=shestitch" -ForegroundColor White
Write-Host "C) Run: php artisan key:generate" -ForegroundColor White
Write-Host "D) Run: php artisan migrate --seed" -ForegroundColor White
Write-Host "E) Run Laravel: php artisan serve" -ForegroundColor White
Write-Host "F) Run chat server: cd ..\\chat-server ; npm install ; npm run dev" -ForegroundColor White

