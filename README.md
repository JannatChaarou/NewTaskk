<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Gestion des Tâches avec Laravel 10

Ce projet est une application de gestion des tâches développée avec Laravel 10. Il permet la création, la mise à jour, la suppression et l'organisation des tâches par catégories et priorités. Il inclut également des fonctionnalités d'authentification, de génération de PDF et d'exportation/importation de fichiers CSV.


## Fonctionnalités

. Gestion des tâches (CRUD)

. Authentification 

. Génération de rapports PDF

. Exportation de données en CSV

. Tests unitaires sur TaskController

## Commandes utilisées dans le projet

-Création des modèles et migrations


php artisan make:model Task -m
php artisan make:model Category -m

-Création des contrôleurs



php artisan make:controller TaskController --resource
php artisan make:controller CategoryController --resource


-Exportation et importation CSV
Le projet utilise maatwebsite/excel pour gérer les fichiers CSV.
Installation :
composer require maatwebsite/excel



php artisan make:export TasksExport --model=Task

-Génération du PDF
Le projet utilise barryvdh/laravel-dompdf pour générer des rapports PDF.
Installation :
composer require barryvdh/laravel-dompdf




-Création des tests

php artisan make:test TaskControllerTest
