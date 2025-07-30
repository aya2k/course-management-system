# Course Management System

A simple Laravel application to manage courses, trainers, and students.

## 🧰 Features

- Trainer can create and manage courses
- Student can view and enroll in available courses
- API authentication using JWT
- Image upload for courses and lessons

## 🛠 Installation Steps

1. Clone the project

```bash
git clone https://github.com/aya2k/course-management-system.git
cd course-management-system
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
Now visit: http://localhost:8000
