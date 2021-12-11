# CMS system with Laravel 8
> CMS Blog system - Fron-end, Admin panel with full registration system (Forgot Password, Reset Password).
> The project is based on the cource "Laravel 8 - Build Advance Ecommerce Project A-Z" by Kazi Ariyan 
> Cource can be found [_here_](https://www.udemy.com/course/laravel-advance-ecommerce-project/).

## Table of Contents
* [General Info](#general-information)
* [Technologies Used](#technologies-used)
* [Features](#features)
* [Screenshots](#screenshots)
* [Setup](#setup)
* [Project Status](#project-status)
* [Contact](#contact)
<!-- * [License](#license) -->


## General Information
- Front-end
- Admin panel
- Full registration system (Forgot Password, Reset Password, Email verification)
- Upload one or more images at a time
- Managing content - text, slider, images

## Technologies Used
- PHP - [vesrion 8.0.8](https://www.php.net/)
- Laravel - [version 8.*](https://laravel.com/)
- Composer - [version 2.1.14](https://getcomposer.org/)
- Node.js - [version 16.9.1](https://nodejs.org/en/)
- MySQL DB

## Features
- PHP image handling and manipulation library - [Intervention Image, v 2.*](http://image.intervention.io/)


## Screenshots
![none for now]()


## Setup for local environment
>The following steps are from cource lectures: Section 2, lectures 7 and 8
- Install PHP >= 7.3. Check PHP installed version with
```sh
php -v
```
- Install development environment [XAMPP](https://www.apachefriends.org/index.html)
- From XAMMP run `Apache Web Server` and `MySQL Database`. Main root dir is `XAMPP/xamppfiles/htdocs`
- Install Node.js (just download and install with few clicks) [from here](https://nodejs.org/en/). Check Node.js installed version with
```sh
node -v
```
- In root dir `XAMPP/xamppfiles/htdocs` create empty folder for the project.
- In cmd cd to the new empty folder and install Composer from by following the [Composer guide](https://getcomposer.org/download/). Check Laravel version with
```sh
php artisan --version
```
- Create new Laravel project in root dir `XAMPP/xamppfiles/htdocs/new_folder`
```sh
composer create-project --prefer-dist laravel/laravel basic
```
- Access the project from browser by typing the path `localhost/new_folder/basic/public` OR from cmd by artisan
```sh
cd basic
php artisan serve
```
and typing in the browser `http://127.0.0.1:8000`


## Project Status
Project is: _in progress_


## Contact
Created by [@Lilyana Vankova](https://github.com/Lilyah) - feel free to contact me!


<!-- Optional -->
<!-- ## License -->
<!-- This project is open source and available under the [... License](). -->

<!-- You don't have to include all sections - just the one's relevant to your project -->
