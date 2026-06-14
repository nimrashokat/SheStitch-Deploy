# SheStitch - Modern Online Tailor Website

SheStitch is a Laravel 10 + Bootstrap 5 tailoring website with user/admin roles, product catalog, custom order form, wishlist, cart, analytics dashboard, and a Node.js + Socket.io live chat server.

## Tech Stack

- Laravel 10 (MVC, auth, migrations, seeders)
- Bootstrap 5 + HTML5 + CSS3 + JavaScript
- MySQL (XAMPP)
- Node.js + Express + Socket.io (real-time chat)
- Chart.js (admin analytics)

## Folder Structure

```
WT LAB Final Project/
  app/
    Http/
      Controllers/
        Admin/
      Middleware/
    Models/
  bootstrap/
  config/
  database/
    migrations/
    seeders/
  public/
    images/
    css/
    js/
  resources/
    views/
      admin/
      auth/
      layouts/
      partials/
      shop/
  routes/
  chat-server/
    package.json
    server.js
```

## Required Composer Packages

- `laravel/framework:^10.0`
- `laravel/tinker:^2.8`

Optional helper packages:
- `barryvdh/laravel-debugbar` (dev)

## Required NPM Packages

Laravel frontend:
- `bootstrap`
- `sass`
- `vite`
- `axios`

Chat server:
- `express`
- `socket.io`
- `cors`
- `dotenv`

## Installation (XAMPP + VS Code)

### Option A (Recommended): 1-command installer

1. Open PowerShell as normal user
2. Go to project folder:
   - `cd "C:\WT LAB Final Project"`
3. Run:
   - `powershell -ExecutionPolicy Bypass -File .\setup.ps1`

This will create a real Laravel app inside:
- `C:\WT LAB Final Project\SheStitch`

Then follow the on-screen steps (DB + migrate + run).

### Option B: Manual

1. Put project in: `C:\WT LAB Final Project`
2. Open XAMPP and start **Apache** + **MySQL**
3. Create database in phpMyAdmin:
   - Database name: `shestitch`
4. In project root:
   - `composer install`
   - `php artisan breeze:install`
   - `copy .env.example .env`
   - configure DB in `.env`
   - `php artisan key:generate`
   - `php artisan migrate --seed`
   - `npm install`
   - `npm run build` (or `npm run dev`)
5. Run Laravel:
   - `php artisan serve`
6. In separate terminal run chat server:
   - `cd chat-server`
   - `npm install`
   - `npm run dev`
7. Open:
   - Laravel app: [http://127.0.0.1:8000](http://127.0.0.1:8000)
   - Chat server: [http://localhost:4000](http://localhost:4000)

## Database Setup (.env)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shestitch
DB_USERNAME=root
DB_PASSWORD=
```

## Migration Commands

- `php artisan migrate`
- `php artisan db:seed`
- `php artisan migrate:fresh --seed`

## Authentication and Roles

- Laravel Breeze is included for auth views and controllers
- Run:
  - `php artisan breeze:install`
  - `npm install && npm run build`
- `users.role` column used for role-based access:
  - `user`
  - `admin`

## Features Included

- Elegant feminine responsive homepage
- User login/register
- Product categories with cards
- Product search + sorting + pagination
- Wishlist/favorites + cart
- Custom tailoring order form with image upload
- Professional size chart
- Testimonials (6 reviews)
- Admin dashboard + charts + management modules
- Node.js live chat between users and admin

## Dummy Data

Seeders include:
- 9 tailoring categories
- Sample products and prices
- Sample customer reviews

