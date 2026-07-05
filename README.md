# LifeFlow – Integrated Productivity & Wellness Platform

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-3.x-003B57?logo=sqlite&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?logo=javascript&logoColor=black)
![Chart.js](https://img.shields.io/badge/Chart.js-3.x-FF6384?logo=chartdotjs&logoColor=white)

## 🚀 Live Demo

🔗 [View Live Demo](https://stuiis.cms.gre.ac.uk/zh1440p/lifeflow/index.php)

## 📋 Overview

LifeFlow is a web-based platform that combines **task management** with **wellness tracking** on a single dashboard. It helps students and professionals understand how their sleep, exercise, and mood affect their productivity through automated correlation insights.

**The Problem:** Users currently switch between separate apps (Todoist for tasks, Apple Health for wellness) – causing cognitive load and missed insights.

**The Solution:** LifeFlow integrates both domains and automatically shows you: *"When you sleep 7+ hours, you complete 28% more tasks."*

## ✨ Key Features

- **Unified Dashboard** – Tasks and wellness metrics side by side
- **Task Management** – CRUD operations with priority colour coding (High = Blue, Medium = Yellow, Low = Grey)
- **Wellness Tracking** – Log sleep, mood, exercise, and energy levels
- **Automated Insights** – Correlation algorithm shows sleep vs productivity, exercise vs mood
- **Interactive Charts** – Dual y-axis line charts and bar-line combinations using Chart.js
- **Admin Panel** – User management with create, edit, delete, and bulk delete
- **Ethical Safety Referrals** – NHS links for severe sleep, mood, or fatigue patterns
- **Role-Based Access Control** – Student vs Admin roles with protected routes
- **WCAG 2.1 AA Compliant** – Keyboard navigation, screen reader support, colour contrast

## 🔒 Security Features

- bcrypt password hashing
- Prepared statements (PDO) – SQL injection prevention
- Role-based access control (student vs admin)
- Session management with timeout
- HTTPS encryption (live demo)
- XSS prevention with custom escape() function

## 🛠️ Tech Stack

| Category | Technologies |
|----------|--------------|
| **Backend** | PHP (PDO), Session Management, bcrypt hashing |
| **Database** | MySQL (live demo), SQLite (local development) |
| **Frontend** | HTML5, CSS3, JavaScript (vanilla) |
| **Visualisation** | Chart.js |
| **Security** | Prepared statements, RBAC, HTTPS |
| **Design** | Figma (high-fidelity prototypes) |
| **Project Management** | Agile (Solo Scrum), Trello |

## 💻 Local Development

### Prerequisites
- XAMPP (or any PHP web server)
- PHP 7.4+ with PDO and SQLite enabled

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/zahidhaf002/LifeFlow.git