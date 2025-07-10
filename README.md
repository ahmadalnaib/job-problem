# 🧠 Humanhup

**Humanhup** is a mobile app built with React Native (Expo) and powered by a Laravel API backend. It helps users track job applications, schedule interviews, and stay productive during the job hunt.

---

## 📱 Mobile App (React Native + Expo)

### Features

- ✅ Add and track job applications
- 📌 Set statuses (Applied, Interview, Offer, etc.)
- 🗓️ Schedule interviews with notifications
- 🧠 Smart follow-up reminders
- 📊 Visual insights into your progress (charts, analytics)

### Tech Stack (Frontend)

- React Native (Expo)
- React Navigation
- Context API 
- Axios (for API calls)
- AsyncStorage (local persistence)
- Tailwind (via NativeWind)
- React Native Chart Kit 

---

## 🔧 Backend (Laravel API)

### Features

- RESTful API for managing users, jobs, interviews, statuses
- Secure authentication with Laravel Sanctum
- API Resources & Form Requests
- Notifications (email and push)
- Soon: Scheduling & Gmail integration

### Tech Stack (Backend)

- Laravel 12+
- Sanctum (Auth)
- MySQL 
- API Resources & Controllers
- Mail / Queue (for notifications)

---

## 🚀 Getting Started

### 1. Clone the Repositories

```bash
# Frontend
git clone (https://github.com/ahmadalnaib/HumanHupApp)
cd humanhup-app
npm install
expo start

# Backend
git clone (https://github.com/ahmadalnaib/job-problem)
cd job-problem
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
