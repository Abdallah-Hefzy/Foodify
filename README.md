# Foodify API 



Foodify API is a RESTful backend application for a food ordering system built with **Laravel 13**. This project is currently under development. The project currently includes the authentication module, which uses Laravel Sanctum for secure API authentication, which uses **Laravel Sanctum** for secure API authentication. 



## Current Features



* User Registration

* User Login

* User Logout

* Phone Verification using OTP

* Forgot Password using OTP

* Password Reset

* Authentication with Laravel Sanctum

* Protected API Routes

* Request Validation



## Tech Stack



* PHP 8.3

* Laravel 13

* Laravel Sanctum

* MySQL



## Installation



Clone the repository:



```bash

git clone https://github.com/Abdallah-Hefzy/Foodify.git

```



Navigate to the project directory:



```bash

cd Foodify

```



Install dependencies:



```bash

composer install

```



Copy the environment file:



```bash

cp .env.example .env

```



Generate the application key:



```bash

php artisan key:generate

```



Configure your database credentials in the `.env` file, then run:



```bash

php artisan migrate

```



Start the development server:



```bash

php artisan serve

```

 



## Authentication



Protected endpoints require a Bearer Token:



```text

Authorization: Bearer YOUR_ACCESS_TOKEN

```



## Project Status



This project is under active development. Currently, the authentication module has been completed, and additional features will be added in future updates.

 