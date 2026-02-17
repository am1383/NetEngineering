# NetEngineering

🎓 **Network Engineering Course – Final Project**

A Laravel-based web application developed as the final project for the Network Engineering course, with a strong emphasis on **clean code**, **security**, **testing**, and **best practices**.

---

## 📖 Introduction

**NetEngineering** is an academic Laravel project designed to demonstrate practical backend development skills alongside fundamental network engineering concepts.  
The project follows modern software engineering principles, focusing on maintainability, scalability, and reliability.

This repository intentionally avoids boilerplate documentation and instead provides **clear, real-world setup instructions and development standards**.

---

## 🎯 Project Goals

- Apply network engineering concepts in a web-based system  
- Build a secure and maintainable Laravel application  
- Practice clean architecture and refactoring  
- Write **unit and integration tests** for reliability  
- Follow industry-standard best practices  

---

## 🧰 Technology Stack

- **PHP** 8.2
- **Laravel** 12.51    
- **MySQL**  
- **Composer**  
- **PHPUnit** (Testing)

---

## ✅ Prerequisites

Before running the project, ensure the following are installed:

- PHP ≥ 8.0  
- Composer  
- MySQL  
- Git   

---

## 📥 Installation & Setup

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/am1383/NetEngineering.git

cd NetEngineering

composer install

cp .env.example .env

php artisan key:generate

php artisan passport:install

php artisan migrate

php artisan db:seed

php artisan serve
```
