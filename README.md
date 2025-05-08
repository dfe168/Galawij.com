# Galawij.com 🎨

**Galawij** is een eenvoudige en moderne webapplicatie voor het beheren en tonen van schilderijen in een online art gallery. De applicatie is gebouwd met [Laravel](https://laravel.com/) (back-end), [Vue.js](https://vuejs.org/) (front-end) en [Inertia.js](https://inertiajs.com/) als brug tussen beide.

🔗 Live versie: [https://galawij.com](https://galawij.com)

---

## Features

-   Schilderijen toevoegen, bewerken en verwijderen
-   Uploaden en weergeven van afbeeldingen
-   Dynamische interface met Vue + Inertia
-   Responsief ontwerp geschikt voor desktop en mobiel
-   Gebruikersauthenticatie via Laravel Auth

---

## Tech Stack

-   **Frameworks**: Laravel 10+, Vue 3, Inertia.js
-   **Database**: MySQL / MariaDB / SQLite
-   **Styling**: Tailwind CSS
-   **Bestandsopslag**: Laravel Filesystem (`public` disk)

---

## Installatie-instructies

1. **Repository klonen**

```bash
git clone https://github.com/dfe168/galawij.git
cd galawij
```

2. **Afhankelijkheden installeren**

```bash
composer install
npm install
```

3. **.env-bestand instellen**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Database migraties uitvoeren**

```bash
php artisan migrate
```

5. **Applicatie starten**

```bash
npm run dev
php artisan serve
```

---

## Belangrijke mappen

-   `resources/js/Pages/` – Vue-componenten per pagina
-   `app/Http/Controllers/` – Laravel controllers
-   `app/Models/` – Eloquent modellen
-   `storage/app/public/` – Geüploade afbeeldingen
-   `database/migrations/` – Databasemigraties

---

## Toekomstige verbeteringen (ideeën)

-   Zoek- en filterfunctionaliteit
-   Publieke galerie met sorteeropties
-   Categorieën of tags voor schilderijen
-   Admin-dashboard
-   Meertalige ondersteuning

---

## Bijdragen?

Bijdragen zijn welkom! Open een issue of maak een pull request via GitHub.
