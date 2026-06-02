# LifeFlow – Integrated Productivity & Wellness Platform

## 🚀 Live Demo

🔗 https://stuiis.cms.gre.ac.uk/zh1440p/lifeflow/index.php

## 📋 Overview

LifeFlow is a web-based platform that combines task management with wellness tracking on a single dashboard. It helps students and professionals understand how their sleep, exercise, and mood affect their productivity through automated correlation insights.

**The Problem:** Users currently switch between separate apps (Todoist for tasks, Apple Health for wellness) – causing cognitive load and missed insights.

**The Solution:** LifeFlow integrates both domains and automatically shows you: "When you sleep 7+ hours, you complete 28% more tasks."

## ✨ Key Features

- Unified Dashboard – Tasks and wellness metrics side by side
- Task Management – CRUD operations with priority colour coding (High = Blue, Medium = Yellow, Low = Grey)
- Wellness Tracking – Log sleep, mood, exercise, and energy levels
- Automated Insights – Correlation algorithm shows sleep vs productivity, exercise vs mood
- Interactive Charts – Dual y-axis line charts and bar-line combinations using Chart.js
- Admin Panel – User management with create, edit, delete, and bulk delete
- Ethical Safety Referrals – NHS links for severe sleep, mood, or fatigue patterns
- Role-Based Access Control – Student vs Admin roles with protected routes
- WCAG 2.1 AA Compliant – Keyboard navigation, screen reader support, colour contrast

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
| Backend | PHP (PDO), Session Management, bcrypt hashing |
| Database | MySQL (live demo), SQLite (local development) |
| Frontend | HTML5, CSS3, JavaScript (vanilla) |
| Visualisation | Chart.js |
| Security | Prepared statements, RBAC, HTTPS |
| Design | Figma (high-fidelity prototypes) |
| Project Management | Agile (Solo Scrum), Trello |

## 💻 Local Development

### Prerequisites
- XAMPP (or any PHP web server)
- PHP 7.4+ with PDO and SQLite enabled

### Setup Instructions

1. Clone the repository:
   git clone https://github.com/zahidhaf002/LifeFlow.git

2. Move to XAMPP htdocs:
   Move the folder to C:\xampp\htdocs\LifeFlow

3. Start Apache in XAMPP Control Panel (MySQL not required)

4. Access the application:
   http://localhost:8080/LifeFlow/ (if Apache on port 8080)
   http://localhost/LifeFlow/ (if Apache on port 80)

### Demo Accounts

| Role | Email | Password |
|------|-------|----------|
| Student (demo) | demo@example.com | demo1234 |
| Admin (demo) | admin@example.com | admin1234 |

Note: You may need to create these accounts via the registration page first.

## Database

This repository includes a SQLite database (data/data.sqlite) for instant local setup – no database configuration required.

For the live demo, the project uses MySQL (university server), demonstrating my ability to work with multiple database systems.

## Report

The full project dissertation (12,000+ words) achieved a First Class grade and is available upon request.

## Author

Zahid Hafesji – BSc Computing, University of Greenwich – First Class

GitHub: https://github.com/zahidhaf002
LinkedIn: https://linkedin.com/in/your-profile

## License

This project is for portfolio purposes. Please contact for permission.
