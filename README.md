<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About SmartHeadTask

# SmartHead Task

A ticket management system built with Laravel 12.

## 🛠 Requirements
- PHP >= 8.2
- Composer
- MySQL

## 🚀 Installation

```bash
git clone https://github.com/anvarbek001/SmartHeadTask.git
cd SmartHeadTask
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

## 📖 API Documentation
http://your-localhost/docs/api


## 📦 Dependencies

| Package | Version | Description |
|---------|---------|-------------|
| [Laravel](https://laravel.com) | ^12.0 | PHP web framework |
| [Spatie Media Library](https://github.com/spatie/laravel-medialibrary) | ^11.0 | File & media management |
| [Barryvdh DomPDF](https://github.com/barryvdh/laravel-dompdf) | ^3.0 | PDF generation |
| [Scramble](https://scramble.dedoc.co) | ^0.12 | Auto API documentation |

