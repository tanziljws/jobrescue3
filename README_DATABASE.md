# Database Setup

## For Railway (Production)

1. Add MySQL Database in Railway Dashboard
2. Railway will auto-set these environment variables:
   - `MYSQL_URL`
   - `MYSQL_HOST`
   - `MYSQL_PORT`
   - `MYSQL_DATABASE`
   - `MYSQL_USER`
   - `MYSQL_PASSWORD`

3. Set these in your Laravel service variables:
   ```
   DB_CONNECTION=mysql
   DB_HOST=${MYSQL_HOST}
   DB_PORT=${MYSQL_PORT}
   DB_DATABASE=${MYSQL_DATABASE}
   DB_USERNAME=${MYSQL_USER}
   DB_PASSWORD=${MYSQL_PASSWORD}
   ```

4. Import SQL dump (optional):
   - Connect to Railway MySQL using Railway CLI or phpMyAdmin
   - Import `jobrescue (4).sql`

## For Local Development

1. Create database:
   ```sql
   CREATE DATABASE jobrescue;
   ```

2. Import SQL dump:
   ```bash
   mysql -u root -p jobrescue < "jobrescue (4).sql"
   ```

3. Or use Laravel migrations:
   ```bash
   php artisan migrate:fresh --seed
   ```

## Environment Variables

Make sure to set in Railway:
- `APP_KEY` (generate with `php artisan key:generate --show`)
- `APP_ENV=production`
- `APP_DEBUG=false`
- Database credentials (auto-set by Railway MySQL)
