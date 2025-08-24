# IdeaHoliday — Ready-to-Launch Bundle (Laravel API + Next.js B2B/B2C + Docker)

This bundle lets you launch a **white-label flights & hotels** platform quickly:
- **Laravel API** (multi-tenant, TBO adapters stubs, payments stubs, wallet)
- **Next.js B2B** and **B2C** frontends
- **Docker Compose** for Nginx + PHP-FPM + MySQL + Redis
- **Production-ready Nginx** configs and **.env** templates
- **Setup scripts** (macOS/Linux) to scaffold Laravel/Next.js and apply code overlays

> You will run a setup script once that creates the Laravel/Next.js apps, installs deps, and copies our code. After that, `docker compose up -d` runs everything.

## Quick Start (Local with Docker)
```bash
unzip ideaholiday-ready.zip && cd ideaholiday-ready

# 1) One-time scaffold (creates apps/api, apps/b2c, apps/b2b)
bash scripts/setup_scaffold.sh

# 2) Copy envs
cp env/api.env apps/api/.env
cp env/b2c.env apps/b2c/.env.local
cp env/b2b.env apps/b2b/.env.local

# 3) Start containers
docker compose up -d

# 4) Install PHP deps inside API container & migrate DB
docker compose exec api composer install
docker compose exec api php artisan key:generate
docker compose exec api php artisan migrate --seed
docker compose exec api php artisan storage:link
```

Open:
- API health: http://localhost:8080/api/ping (send header `X-Tenant-Domain: ideaholiday.local`)
- B2C: http://localhost:3000
- B2B: http://localhost:3001

## Production (DigitalOcean droplet)
1. Create a droplet (Ubuntu 22.04/24.04, 2–4GB RAM), install Docker & Compose V2.
2. Copy this folder to the server (e.g., `scp -r ideaholiday-ready root@SERVER:/opt/ideaholiday`).
3. Set real `.env` values in `env/api.env` (TBO, Razorpay/Easebuzz, SMTP, WhatsApp).
4. `docker compose up -d` then run the same **composer/artisan** commands inside the `api` container.
5. Point DNS to the server and add your production **server_name** in `ops/nginx/*.conf`, restart Nginx container.

## Notes
- The Laravel/TBO/Payment logic is injected from `overlays/api` into the Laravel app during setup.
- The Next.js apps receive minimal pages that call the API; extend UI as needed.
- Webhook endpoints are created but you must paste real secrets in env to verify signatures.
