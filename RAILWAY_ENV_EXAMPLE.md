# Railway Environment Variables - Production

## PERBAIKAN YANG DIPERLUKAN:

### 1. APP_URL - PENTING! ⚠️
Ganti dengan URL Railway Anda:
```
APP_URL="https://jobrescue3-production.up.railway.app"
```
(Jangan lupa ganti dengan URL Railway Anda yang sebenarnya)

---

## Environment Variables yang BENAR untuk Railway:

```env
APP_NAME="JobRescue"
APP_ENV="production"
APP_DEBUG="false"
APP_KEY="base64:t7fJzqMzGpCsho3gLA9sF301V/+bINGkX8Nw38Xttk8="
APP_URL="https://jobrescue3-production.up.railway.app"
APP_LOCALE="id"
APP_FALLBACK_LOCALE="en"
APP_FAKER_LOCALE="en_US"

# Database Configuration (SUDAH BENAR ✅)
DB_CONNECTION="mysql"
DB_HOST="nozomi.proxy.rlwy.net"
DB_PORT="44553"
DB_DATABASE="railway"
DB_USERNAME="root"
DB_PASSWORD="uwkPZBNfnVJsBuXSucLYweQaJFltOmdp"
DB_URL="mysql://root:uwkPZBNfnVJsBuXSucLYweQaJFltOmdp@nozomi.proxy.rlwy.net:44553/railway"

# Session Configuration (SUDAH BENAR ✅)
SESSION_DRIVER="database"
SESSION_LIFETIME="120"
SESSION_ENCRYPT="false"

# Cache & Queue (SUDAH BENAR ✅)
CACHE_DRIVER="file"
QUEUE_CONNECTION="sync"

# Mail Configuration (Optional - bisa disesuaikan)
MAIL_MAILER="smtp"
MAIL_HOST="smtp.mailtrap.io"
MAIL_PORT="2525"
MAIL_USERNAME="null"
MAIL_PASSWORD="null"
MAIL_ENCRYPTION="null"
MAIL_FROM_ADDRESS="hello@jobrescue.com"
MAIL_FROM_NAME="${APP_NAME}"

# AWS (Kosongkan jika tidak pakai)
AWS_ACCESS_KEY_ID=""
AWS_SECRET_ACCESS_KEY=""
AWS_DEFAULT_REGION="us-east-1"
AWS_BUCKET=""
AWS_USE_PATH_STYLE_ENDPOINT="false"

# Redis (Default untuk Railway - bisa dikosongkan atau diset)
REDIS_HOST="127.0.0.1"
REDIS_PASSWORD="null"
REDIS_PORT="6379"

# Vite/Pusher (Jika tidak pakai bisa dikosongkan)
VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

# Railway Environment Variables (OTOMATIS)
RAILWAY_ENVIRONMENT="production"
RAILWAY_GIT_COMMIT_SHA="${RAILWAY_GIT_COMMIT_SHA:-local}"
RAILWAY_GIT_AUTHOR="${RAILWAY_GIT_AUTHOR:-local}"
RAILWAY_GIT_BRANCH="${RAILWAY_GIT_BRANCH:-main}"
RAILWAY_GIT_REPO_NAME="${RAILWAY_GIT_REPO_NAME:-jobrescue3}"
RAILWAY_GIT_REPO_OWNER="${RAILWAY_GIT_REPO_OWNER:-tanziljws}"

# Logging
LOG_CHANNEL="stderr"
LOG_LEVEL="debug"
```

---

## Checklist Sebelum Deploy:

✅ **PASTIKAN:**
1. ✅ APP_URL sudah diganti dengan URL Railway Anda yang sebenarnya (dari error sebelumnya: `https://jobrescue3-production.up.railway.app`)
2. ✅ Database credentials sudah benar (sudah ✅)
3. ✅ APP_KEY sudah di-set (sudah ✅)
4. ✅ SESSION_DRIVER sudah di-set ke "database" (sudah ✅)
5. ✅ Database migrations sudah di-run di Railway (jalankan `php artisan migrate` di Railway)

---

## Catatan Penting:

1. **APP_URL**: Ganti `https://jobrescue3-production.up.railway.app` dengan URL Railway Anda yang sebenarnya jika berbeda
2. **Database**: Config sudah support baik `DB_*` variables maupun `MYSQL*` variables (Railway auto-inject)
3. **Sessions**: Table sessions sudah ada di migration, jadi tidak perlu tambah migration lagi
4. **SSL**: Jika Railway MySQL require SSL, mungkin perlu set `MYSQL_ATTR_SSL_CA` (tapi biasanya tidak perlu)

---

## Pakai PostgreSQL di Railway ✅

**Format DATABASE_URL yang BENAR untuk PostgreSQL di Railway:**

```env
# Ganti koneksi ke Postgres
DB_CONNECTION="pgsql"

# Pakai DATABASE_URL (Format Railway - PASTIKAN pakai "postgresql://")
DATABASE_URL="postgresql://postgres:AQBAWVQXZFxwgssCksLcOlKicSvAxniO@nozomi.proxy.rlwy.net:55832/railway"

# Catatan: Formatnya adalah:
# postgresql://[USERNAME]:[PASSWORD]@[HOST]:[PORT]/[DATABASE]
# JANGAN pakai "postgres://" tapi "postgresql://"

# Session tetap pakai database (tabel sessions sudah ada di migration)
SESSION_DRIVER="database"
```

**Atau jika Railway auto-inject PGHOST, PGPORT, dll:**

```env
DB_CONNECTION="pgsql"
DB_HOST="${PGHOST}"
DB_PORT="${PGPORT}"
DB_DATABASE="${PGDATABASE}"
DB_USERNAME="${PGUSER}"
DB_PASSWORD="${PGPASSWORD}"
```

**Langkah Setup:**
1. ✅ Tambahkan PostgreSQL service di Railway Dashboard
2. ✅ Copy `DATABASE_URL` dari Railway PostgreSQL service
3. ✅ Set `DB_CONNECTION="pgsql"` dan `DATABASE_URL` di environment variables
4. ✅ Redeploy aplikasi
5. ✅ Jalankan migrations: `php artisan migrate --force` (via Railway console atau deploy command)

**Catatan Penting:**
- ✅ Config `database.php` sudah support `DATABASE_URL` untuk PostgreSQL
- ✅ Schema migrations kompatibel dengan PostgreSQL (pakai Laravel types: enum, json, decimal, foreignId)
- ✅ Tidak ada MySQL-specific syntax di migrations
- ⚠️ Format harus `postgresql://` bukan `postgres://` untuk Railway

