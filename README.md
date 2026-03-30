# 🗳️ Online Voting Platform - Night of the Scientific Woman

![Online Voting](https://img.shields.io/badge/System-Online%20Voting-green)
![Laravel](https://img.shields.io/badge/Laravel-Framework-red)
![PHP](https://img.shields.io/badge/PHP-Backend-blue)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
![FedaPay](https://img.shields.io/badge/Payment-FedaPay-brightgreen)
![MVC](https://img.shields.io/badge/Architecture-MVC-purple)
![Secure](https://img.shields.io/badge/Security-CSRF%20Protected-lightgrey)

> Online voting web application developed as a duo for the **National University of Sciences, Technologies, Engineering and Mathematics (UNSTIM)** in Benin, as part of the event **"La Nuit de la Femme Scientifique"** - election of the best female scientist of the university (2023-2024).

---

## 📌 Description

Complete web platform allowing users to vote for their favorite candidate during the election organized by UNSTIM. The system includes user account management, secure voting sessions, automatic result counting and online payment via **FedaPay**.

---

## 📸 Application Preview

![Home](https://raw.githubusercontent.com/lenaic-hounleba/vote-unstim/main/public/imgs/NFS.png)

---

## ⚙️ Tech Stack

- **Backend** : PHP · Laravel (MVC framework)
- **Database** : MySQL · Eloquent ORM
- **Frontend** : HTML5 · CSS3 · Bootstrap · JavaScript
- **Payment** : FedaPay (API integration)
- **Authentication** : Laravel Sanctum
- **Tests** : PHPUnit
- **Tools** : Composer · Artisan CLI · Vite

---

## 🧠 Main Features

- 🗳️ Vote for a candidate (conditioned on payment)
- 💳 Online payment via **FedaPay** to validate the vote
- 📊 Automatic counting and real-time display of results
- 🛡️ Administration interface to manage candidates and votes
- 🔒 Data integrity guaranteed (one vote per user, with the possibility of multiple votes at once, the amount multiplies)

---

## 🏗️ Project Architecture

```
vote-unstim/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # route logic (vote, admin, payment)
│   │   └── Middleware/        # authentication, admin access
│   └── Models/
│       ├── Candidate.php      # candidate model
│       ├── User.php           # user model
│       └── Vote.php           # vote model
├── database/
│   ├── migrations/            # table structure (users, candidates, votes)
│   └── seeders/
├── resources/
│   └── views/                 # Blade templates
│       ├── index.blade.php    # home page / candidates list
│       ├── vote.blade.php     # voting page
│       └── admin.blade.php    # admin interface
├── routes/
│   └── web.php                # route definitions
├── config/
│   └── fedapay.php            # FedaPay payment configuration
└── public/
    ├── css/                   # custom styles
    └── imgs/                  # candidates photos
```

---

## 🔄 Voting Flow

```
User arrives on the site
        ↓
Browses the candidates
        ↓
Selects a candidate
        ↓
Payment via FedaPay
        ↓
Vote recorded in database
        ↓
Results updated in real time
```

---

## 🚀 Local Installation

### Prerequisites
- PHP 8+ · Composer · MySQL · Node.js

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/lenaic-hounleba/vote-unstim.git
cd vote-unstim

# 2. Install dependencies
composer install

# 3. Configure the environment
cp .env.example .env
# → Fill in DB_*, FEDAPAY_SECRET_KEY, APP_URL

# 4. Generate the application key
php artisan key:generate

# 5. Migrate the database
php artisan migrate

# 6. Start the server
php artisan serve
```

---

## 🔐 Security & Integrity

- Authentication via **Laravel Sanctum**
- Vote conditioned on FedaPay payment (fraud prevention)
- Native Laravel CSRF protection
- Role management: user / administrator via **middlewares**

---

## ⚠️ Limits

> Project carried out in an event context with tight deadlines.

- Application not actively maintained after the event

---

## 👥 Team

Project carried out as a **duo** - client order for UNSTIM (Benin), as part of the **"Nuit de la Femme Scientifique" 2023-2024**.

---

## 📚 Skills Demonstrated

- **Full Stack** development with Laravel (MVC, routes, middlewares, Eloquent ORM)
- Integration of an **online payment** system (FedaPay)
- Management of **data integrity** in a voting system
- Deployment and configuration of a Laravel application in production

---

## 👨‍💻 Author

**Lenaïc Love HOUNLEBA**  
CEO & Full Stack Developer - [ComeUp](https://comeup.com/fr/@lenaic-1)

🔗 GitHub : [github.com/lenaic-hounleba](https://github.com/lenaic-hounleba)  
📧 lovehounleba@gmail.com

---

> *Project carried out for UNSTIM (Benin) - "La Nuit de la Femme Scientifique" event, 2023-2024.*
