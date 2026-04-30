# Protiddhoni CMS

Admin CMS for the Protiddhoni / VoiceReach marketing site — built with Laravel 10 + Filament 3 + MySQL, designed to deploy on cPanel shared hosting.

## What this CMS manages

- **Blog** — posts, categories, tags, authors, featured images
- **Page content blocks** — homepage hero, FAQ, testimonials, pricing tiers (no code edits needed)
- **Contact submissions inbox** — leads from the marketing site contact form
- **Newsletter subscribers** — email list with CSV export
- **Settings** — site-wide config (contact emails, branding, social, SEO)

The static marketing-site HTML pages fetch this content via JSON API at `/api/...`.

---

## 1. Local development (XAMPP / Windows)

### Prerequisites

- PHP 8.1+ (XAMPP ships with this)
- Composer ([getcomposer.org](https://getcomposer.org/))
- MySQL (XAMPP ships with this)
- Node.js 18+ (only if you want to compile assets — not required for basic usage)

### Setup steps

```bash
# 1. Clone or copy the cms/ folder to your XAMPP htdocs
cp -r cms C:/xampp/htdocs/protiddhoni-cms

# 2. Install PHP dependencies
cd C:/xampp/htdocs/protiddhoni-cms
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate APP_KEY
php artisan key:generate

# 5. Create the database in phpMyAdmin
#    Visit http://localhost/phpmyadmin
#    Create database: protiddhoni_cms (utf8mb4_unicode_ci)

# 6. Edit .env — set DB_DATABASE, DB_USERNAME (root), DB_PASSWORD (blank by default in XAMPP)

# 7. Run migrations + seed defaults
php artisan migrate --seed

# 8. Create storage symlink (for uploaded images)
php artisan storage:link

# 9. Serve the app
php artisan serve --port=8000
```

Open [http://localhost:8000/admin](http://localhost:8000/admin)

**Default admin credentials** (change immediately):
- Email: `admin@protiddhoni-bd.com`
- Password: `change-me-now`

---

## 2. cPanel deployment (shared hosting, production)

cPanel shared hosting hosts the public web root at `public_html/`. Laravel's entry point is its `public/` folder. Two clean ways to deploy:

### Option A — Subdomain (recommended)

Set up `cms.protiddhoni-bd.com` as a subdomain. cPanel will create `~/cms.protiddhoni-bd.com/` as its document root.

```
~/
├── protiddhoni-cms/          ← upload entire cms/ folder here
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/               ← run `composer install` locally and upload, OR use cPanel Composer
│   ├── .env                  ← production env (see below)
│   └── ...
│
└── cms.protiddhoni-bd.com/   ← subdomain document root → point to .../protiddhoni-cms/public
```

Edit your subdomain's document root in cPanel → "Domains" → set it to `~/protiddhoni-cms/public`.

### Option B — Subdirectory (no subdomain)

Upload `cms/` content to `~/protiddhoni-cms/`, copy `public/` files into a directory under `public_html/`, and patch entry-point paths. More fragile — prefer Option A.

### Detailed deploy steps (Option A)

1. **Build locally first**
   ```bash
   cd cms/
   composer install --optimize-autoloader --no-dev
   ```

2. **Create production `.env`** (do NOT upload local `.env`):
   ```env
   APP_NAME="Protiddhoni CMS"
   APP_ENV=production
   APP_KEY=base64:GENERATED_KEY_HERE
   APP_DEBUG=false
   APP_URL=https://cms.protiddhoni-bd.com
   APP_TIMEZONE=Asia/Dhaka

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=cpanel_user_protiddhoni_cms
   DB_USERNAME=cpanel_user_dbuser
   DB_PASSWORD=YOUR_DB_PASSWORD

   FILESYSTEM_DISK=public
   SESSION_DRIVER=file
   CACHE_DRIVER=file
   QUEUE_CONNECTION=database

   MAIL_MAILER=smtp
   MAIL_HOST=mail.protiddhoni-bd.com
   MAIL_PORT=587
   MAIL_USERNAME=hello@protiddhoni-bd.com
   MAIL_PASSWORD=YOUR_MAIL_PASSWORD
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="hello@protiddhoni-bd.com"
   MAIL_FROM_NAME="Protiddhoni"

   FILAMENT_PATH=admin
   MARKETING_SITE_URL=https://protiddhoni-bd.com
   CUSTOMER_DASHBOARD_URL=https://app.protiddhoni-bd.com
   ```

3. **Upload via FTP / cPanel File Manager**
   - Compress `cms/` to ZIP locally
   - cPanel → File Manager → upload to home directory
   - Right-click → Extract → rename to `protiddhoni-cms`

4. **Create MySQL database in cPanel**
   - cPanel → "MySQL Databases"
   - Create database: `cpaneluser_protiddhoni_cms`
   - Create user with strong password
   - Grant ALL privileges to the user on the database

5. **Set subdomain document root**
   - cPanel → "Domains" → "Create A New Domain" → `cms.protiddhoni-bd.com`
   - Set document root to `/home/cpaneluser/protiddhoni-cms/public`

6. **Set storage permissions**
   ```bash
   # via cPanel Terminal or SSH
   cd ~/protiddhoni-cms
   chmod -R 775 storage bootstrap/cache
   ```

7. **Run migrations** (cPanel Terminal — most hosts include it)
   ```bash
   cd ~/protiddhoni-cms
   php artisan migrate --force --seed
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

   If your cPanel doesn't have Terminal, ask support to enable it, or run migrations via a one-time `migrate.php` script (delete after).

8. **Verify SSL**
   - cPanel → "SSL/TLS Status" → confirm Let's Encrypt cert installed for `cms.protiddhoni-bd.com`

9. **Open** [https://cms.protiddhoni-bd.com/admin](https://cms.protiddhoni-bd.com/admin)
   - Login with seeded credentials
   - **Immediately** go to "Admins" → change your password

---

## 3. Connecting the marketing site to this CMS

The static HTML marketing pages (frontend.html, blog.html, contact.html, etc.) need to call the CMS API. Add a small JS snippet to each page:

```js
const CMS_BASE = 'https://cms.protiddhoni-bd.com/api';

// Fetch blog posts on blog.html
fetch(`${CMS_BASE}/posts?per_page=12`)
    .then(r => r.json())
    .then(({ data }) => renderPosts(data));

// Submit contact form on contact.html
document.querySelector('#contactForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = Object.fromEntries(new FormData(e.target));
    const res = await fetch(`${CMS_BASE}/contact`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
    });
    const json = await res.json();
    alert(json.message);
});
```

CORS is already enabled for any domain in `routes/web.php`. For tighter security, edit `app/Http/Middleware/Cors.php` (will be added in Phase 2) to whitelist only `protiddhoni-bd.com`.

---

## 4. API endpoints (consumed by the marketing site)

| Method | URL | Purpose |
|---|---|---|
| GET  | `/api/posts`            | List published blog posts (paginated, filterable) |
| GET  | `/api/posts/{slug}`     | Single blog post (auto-increments view count) |
| GET  | `/api/categories`       | All blog categories with post counts |
| GET  | `/api/tags`             | All blog tags |
| GET  | `/api/blocks/homepage`  | All editable content for the homepage |
| GET  | `/api/blocks/homepage.hero.headline` | Single block by exact key |
| POST | `/api/contact`          | Submit contact form (rate-limited 6/min/IP) |
| POST | `/api/newsletter`       | Newsletter signup (rate-limited 6/min/IP) |

---

## 5. Folder structure

```
cms/
├── app/
│   ├── Filament/Resources/  ← admin panel resources (BlogPost, BlogCategory, ...)
│   ├── Http/Controllers/Api ← public API endpoints
│   ├── Models/              ← Eloquent models (BlogPost, PageBlock, Setting, ...)
│   ├── Notifications/       ← email notifications
│   └── Providers/Filament/  ← Filament panel provider (theme + middleware)
├── bootstrap/
├── config/                  ← auth.php, database.php
├── database/
│   ├── migrations/          ← 10 schema migrations (admins, blog_*, page_blocks, ...)
│   └── seeders/             ← default admin + page blocks + sample post
├── public/                  ← cPanel document root (index.php + .htaccess)
├── resources/views/         ← Blade templates (Filament uses its own)
├── routes/web.php           ← public API routes
├── storage/                 ← logs, uploads, cache (chmod 775)
├── .env.example             ← copy to .env and fill in
└── composer.json
```

---

## 6. Security checklist before going live

- [ ] Changed default super-admin password (`admin@protiddhoni-bd.com / change-me-now`)
- [ ] `APP_DEBUG=false` in production `.env`
- [ ] Strong `APP_KEY` generated (`php artisan key:generate`)
- [ ] Database user has minimum required privileges
- [ ] HTTPS enabled (Let's Encrypt cert)
- [ ] `storage/` and `bootstrap/cache/` are 775, owned by web user
- [ ] `.env` is NOT in git, NOT publicly accessible
- [ ] `.htaccess` in `public/` correctly routes through `index.php`
- [ ] Rate-limiting tested on `/api/contact` and `/api/newsletter`
- [ ] CORS configured to allow only your marketing domain (Phase 2)

---

## 7. Roadmap

**Phase 1 — DONE (this commit)**
- Schema, models, Filament resources for blog + contact + newsletter + page blocks + settings
- Public API endpoints
- cPanel deploy guide

**Phase 2 — Next**
- CORS middleware (whitelist marketing domain)
- Email templates with brand styling
- Homepage page-blocks → wire actual marketing site to fetch
- Convert blog.html to consume `/api/posts` + render dynamically
- Convert contact.html form to POST to `/api/contact`

**Phase 3 — Later**
- Customer overview (read-only) from your existing dashboard DB
- Voice/sender approval workflows (calls your engine API)
- Analytics widgets in dashboard (calls/day, leads/week, top categories)
- Two-factor auth on admin login
- Activity log (audit trail of admin actions)
