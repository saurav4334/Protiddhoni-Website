# VoiceReach — Voice Message SaaS Platform

A scalable, fully dynamic SaaS marketing website + admin CMS for a voice broadcasting service. **No voice engine, no auth API** — the frontend is a marketing / conversion site that redirects users to an external control panel via configurable URLs managed from the CMS.

## What's included

| File | What it is |
|---|---|
| `frontend.html` | The public marketing website — Hero, Features, Use Cases, How It Works, Pricing, Testimonials, FAQ, Contact, Footer, WhatsApp float, EN/BN switcher |
| `admin.html` | The admin panel (CMS) — Dashboard, content editors for every section, Redirect URL manager, Media library, SEO, Leads inbox, Admin users |
| `database_schema.sql` | Complete MySQL schema (14 tables) with seed data |

Open `frontend.html` and `admin.html` in a browser to preview both UIs.

## Architecture

```
┌──────────────────────────┐     reads     ┌──────────────────────┐
│  Frontend (Next.js/PHP)  │ ────────────► │   MySQL / CMS DB     │
│  public SaaS marketing   │               │  pages, features,    │
│  Tailwind CSS            │               │  pricing, settings,  │
└──────────┬───────────────┘               │  testimonials, etc.  │
           │ click "Signup"                 └───────────▲──────────┘
           │ redirects to settings.signup_url           │ writes
           ▼                                            │
   https://yourvoicepanel.com/signup          ┌────────┴─────────┐
   (external, not built here)                 │  Admin Panel CMS │
                                              │  Laravel/Node    │
                                              │  auth + forms    │
                                              └──────────────────┘
```

## The redirect system (important)

Instead of building signup/login, the site reads two values from the `settings` table:

```sql
SELECT value FROM settings WHERE `group`='redirect' AND `key`='signup_url';
SELECT value FROM settings WHERE `group`='redirect' AND `key`='login_url';
```

Every `Get Started`, `Sign Up`, and `Login` button on the site uses these URLs. The admin changes them from the Redirect URLs page in the CMS — changes apply instantly sitewide, no deploy needed.

## Tech stack (recommended)

**Frontend**
- Next.js 14 (App Router) + Tailwind CSS
- Server components fetch content from MySQL at request time or at build (ISR)
- i18n with `next-intl` for English + Bangla

**Backend (CMS)**
- Laravel 11 (fastest path for a rich CMS) — Filament or Nova for the admin UI
- Alternative: Node.js + Express + Prisma if the team prefers JS end-to-end

**Database**
- MySQL 8
- Media stored on S3 / DigitalOcean Spaces (path saved in `media` table)

## CMS flow

1. Admin logs in at `/admin` (Laravel auth, rate-limited, optional 2FA).
2. Selects a section from the sidebar (Hero, Features, Pricing, etc.).
3. Edits fields in a form — saves write to MySQL and log to `activity_logs`.
4. Frontend re-renders on next request (or via webhook-triggered ISR revalidate on Next.js).
5. Contact form submissions land in `contacts` — visible in the Leads Inbox, exportable as CSV.

## Database tables (14)

`pages`, `sections`, `features`, `use_cases`, `how_it_works`, `pricing_plans`, `testimonials`, `faqs`, `settings`, `media`, `contacts`, `admin_users`, `activity_logs`, `blog_posts`

See `database_schema.sql` for the full DDL, foreign keys, indexes, and seed values for the critical redirect + SEO + contact settings.

## Security

- Admin routes behind auth middleware, CSRF protected
- Password hashing via bcrypt/argon2
- Role-based access (`super_admin`, `admin`, `editor`) enforced at the controller layer
- Rate limiting on login (5/min) and contact form (10/hour per IP)
- Input validation + HTML sanitization on all textareas
- Secrets (DB, S3) in `.env`, never committed

## Deployment

**Frontend** → Vercel (Next.js) or Nginx + PHP-FPM if Laravel-blade
**Backend/CMS** → Any VPS with PHP 8.2 + MySQL, or DigitalOcean App Platform
**DB** → Managed MySQL (RDS / DO / PlanetScale)
**Media** → S3 or DO Spaces behind a CDN
**Domain** → Cloudflare in front of everything for CDN + WAF

## Extras delivered in the mockups

- Floating WhatsApp button (frontend.html, bottom-right)
- Language switcher EN/BN in the navbar
- Animated waveform on the hero campaign card
- Accordion FAQ with smooth expand/collapse
- Dashboard with traffic bar chart + recent leads
- Sortable How-It-Works steps (drag handle in admin)
- Featured pricing plan highlight + custom CTA URL per plan
