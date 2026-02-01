# 🔐 Login & Signup System (PHP & MySQL)

A secure authentication system built with PHP and MySQL featuring user registration, login, session-based access control, and logout functionality. Demonstrates backend fundamentals and security best practices.

## 🚀 Features
- User registration with **password hashing**
- Secure login using **sessions**
- Protected dashboard page
- Logout system
- MySQL database integration.

## 🛠 Tech Stack
- PHP
- MySQL
- HTML5
- CSS3
- Bootstrap 5

## 📁 Files
- index.php
- register.php
- login.php
- logout.php
- dashboard.php
- config.example.php
- users.sql

## ✅ Demo Flow
Register → Login → Access Protected Page → Logout

## 🔑 Security
Passwords are securely stored using:
```php
password_hash($password, PASSWORD_DEFAULT);
