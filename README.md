# 🗳️ Plateforme de vote en ligne - Nuit de la Femme Scientifique

![Online Voting](https://img.shields.io/badge/System-Online%20Voting-green)
![Laravel](https://img.shields.io/badge/Laravel-Framework-red)
![PHP](https://img.shields.io/badge/PHP-Backend-blue)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
![FedaPay](https://img.shields.io/badge/Payment-FedaPay-brightgreen)
![MVC](https://img.shields.io/badge/Architecture-MVC-purple)
![Secure](https://img.shields.io/badge/Security-CSRF%20Protected-lightgrey)

> Application web de vote en ligne développée en binôme pour l'**Université Nationale des Sciences, Technologies, Ingénierie et Mathématiques (UNSTIM)** au Bénin, dans le cadre de l'événement **"La Nuit de la Femme Scientifique"** - élection de la meilleure femme scientifique de l'université (2023-2024).

---

## 📌 Description

Plateforme web complète permettant aux utilisateurs de voter pour leur candidate préférée lors de l'élection organisée par l'UNSTIM. Le système intègre une gestion des comptes utilisateurs, des sessions de vote sécurisées, un comptage automatique des résultats et un paiement en ligne via **FedaPay**.

---

## 📸 Aperçu de l'application

![Accueil](https://raw.githubusercontent.com/lenaic-hounleba/vote-unstim/main/public/imgs/NFS.png)

---

## ⚙️ Stack technique

- **Backend** : PHP · Laravel (framework MVC)
- **Base de données** : MySQL · Eloquent ORM
- **Frontend** : HTML5 · CSS3 · Bootstrap · JavaScript
- **Paiement** : FedaPay (intégration API)
- **Authentification** : Laravel Sanctum
- **Tests** : PHPUnit
- **Outils** : Composer · Artisan CLI · Vite

---

## 🧠 Fonctionnalités principales

- 🗳️ Vote pour une candidate (conditionné au paiement)
- 💳 Paiement en ligne via **FedaPay** pour valider le vote
- 📊 Comptage automatique et affichage des résultats en temps réel
- 🛡️ Interface d'administration pour gérer les candidates et les votes
- 🔒 Intégrité des données garantie (un vote par utilisateur, avec possibilité de faire plusieurs votes en une fois, le montant se multiplie)

---

## 🏗️ Architecture du projet

```
vote-unstim/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # logique des routes (vote, admin, paiement)
│   │   └── Middleware/        # authentification, accès admin
│   └── Models/
│       ├── Candidate.php      # modèle candidat
│       ├── User.php           # modèle utilisateur
│       └── Vote.php           # modèle vote
├── database/
│   ├── migrations/            # structure des tables (users, candidates, votes)
│   └── seeders/
├── resources/
│   └── views/                 # templates Blade
│       ├── index.blade.php    # page d'accueil / liste des candidates
│       ├── vote.blade.php     # page de vote
│       └── admin.blade.php    # interface admin
├── routes/
│   └── web.php                # définition des routes
├── config/
│   └── fedapay.php            # configuration paiement FedaPay
└── public/
    ├── css/                   # styles personnalisés
    └── imgs/                  # photos des candidates
```

---

## 🔄 Flux de vote

```
Utilisateur arrive sur le site
        ↓
Consulte les candidates
        ↓
Sélectionne une candidate
        ↓
Paiement via FedaPay
        ↓
Vote enregistré en base
        ↓
Résultats mis à jour en temps réel
```

---

## 🚀 Installation locale

### Prérequis
- PHP 8+ · Composer · MySQL · Node.js

### Étapes

```bash
# 1. Cloner le dépôt
git clone https://github.com/lenaic-hounleba/vote-unstim.git
cd vote-unstim

# 2. Installer les dépendances
composer install

# 3. Configurer l'environnement
cp .env.example .env
# → Renseigner DB_*, FEDAPAY_SECRET_KEY, APP_URL

# 4. Générer la clé applicative
php artisan key:generate

# 5. Migrer la base de données
php artisan migrate

# 6. Lancer le serveur
php artisan serve
```

---

## 🔐 Sécurité & intégrité

- Authentification via **Laravel Sanctum**
- Vote conditionné au paiement FedaPay (prévention des fraudes)
- Protection CSRF native Laravel
- Gestion des rôles : utilisateur / administrateur via **middlewares**

---

## ⚠️ Limites

> Projet réalisé dans un contexte événementiel avec des délais contraints.

- Application non maintenue activement après l'événement

---

## 👥 Équipe

Projet réalisé en **binôme** - commande client pour l'UNSTIM (Bénin), dans le cadre de la **"Nuit de la Femme Scientifique" 2023-2024**.

---

## 📚 Compétences mobilisées

- Développement **Full Stack** avec Laravel (MVC, routes, middlewares, Eloquent ORM)
- Intégration d'un système de **paiement en ligne** (FedaPay)
- Gestion de **l'intégrité des données** dans un système de vote
- Déploiement et configuration d'une application Laravel en production

---

## 👨‍💻 Auteur

**Lenaïc Love HOUNLEBA**  
CEO & Développeur Full Stack - [ComeUp](https://comeup.com/fr/@lenaic-1)

🔗 GitHub : [github.com/lenaic-hounleba](https://github.com/lenaic-hounleba)  
📧 lovehounleba@gmail.com

---

> *Projet réalisé pour l'UNSTIM (Bénin) - événement "La Nuit de la Femme Scientifique", 2023-2024.*
