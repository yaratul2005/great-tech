# Great Ten Technology - Software Licensing Platform

A Laravel-based software licensing platform for WordPress themes/plugins, code projects, and bot scripts with comprehensive admin controls and API integration.

## Features

- **Admin Panel**: Manage tools, licenses, and users
- **License API**: Generate and verify licenses via API
- **Protected Downloads**: Domain-restricted file downloads
- **Portfolio Website**: Showcases themes, plugins, projects, bots, and docs
- **Shared Hosting Compatible**: No SSH/CLI required for deployment

## Requirements

- PHP 8.2+
- MySQL 5.7+ or MariaDB 10.3+
- Web server (Apache/Nginx)
- Composer

## Installation

### Step 1: Clone and Setup

```bash
# Download the project
git clone <repository-url> great10-local
cd great10-local

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

Update `.env` file:
```
APP_NAME="Great Ten Technology"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=great10_db
DB_USERNAME=great10_user
DB_PASSWORD=your_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### Step 2: Database Setup

```bash
# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed
```

### Step 3: File Storage

```bash
# Create symbolic link for file uploads
php artisan storage:link
```

## API Endpoints

### License Management

- `POST /api/licenses/generate` - Generate a new license
- `GET /api/licenses/{key}/verify?domain=example.com` - Verify a license
- `GET /api/licenses/{key}/validate` - Enhanced verification with IP tracking

### Tool Information

- `GET /api/tools` - List all published tools
- `GET /api/tools/{slug}` - Get specific tool details

### Protected Downloads

- `POST /api/downloads/{license_key}` - Secure file download with verification

## Admin Panel

After installation:

1. Register a new account
2. In the database, set `is_admin=1` for your user account
3. Access admin panel at `/admin`

## License Format

Generated license keys follow the format: `GT10-XXXX-XXXX-XXXX-XXXX`

Where each `XXXX` represents a 4-character hex string.

## Deployment to Shared Hosting

### Via cPanel File Manager

1. Zip the entire project (excluding `node_modules`)
2. Upload the zip file to your hosting account via File Manager
3. Extract the zip file
4. Move contents from `public` folder to `public_html`
5. Edit `public_html/index.php` to point to the Laravel installation:

```php
require __DIR__.'/../great10/vendor/autoload.php';
$app = require_once __DIR__.'/../great10/bootstrap/app.php';
```

6. Create `.env` file in your Laravel root with production settings
7. Set permissions:
   - `storage/` and subdirectories: 775
   - `bootstrap/cache/`: 775
   - All other files: 644

### Database Setup on Hosting

1. Create a database via cPanel
2. Create a database user and assign privileges
3. Import your schema and seed data via phpMyAdmin

### Cache Clearing on Shared Hosting

Access `yoursite.com/artisan.php` to run artisan commands via web interface.

## License Validation Process

1. Customer purchases a license
2. License key is generated with domain binding
3. Customer integrates the key into their application
4. Application validates the license via API (`/api/licenses/{key}/verify`)
5. On successful validation, customer can download the product

## Security Features

- Domain binding prevents license sharing
- IP tracking for download monitoring
- Expired license detection
- Download limits enforcement
- API rate limiting

## Troubleshooting

### Common Issues

- **500 Internal Server Error**: Check file permissions and error logs
- **Database Connection Error**: Verify database credentials in `.env`
- **File Download Issues**: Ensure `storage` directory is linked properly
- **Slow Performance**: Enable OPcache in your hosting control panel

### Debugging API

Use a tool like Postman to test API endpoints:

```bash
# Generate a license
curl -X POST https://great10.xyz/api/licenses/generate \
  -H "Content-Type: application/json" \
  -d '{"tool_id":1,"domain":"testsite.com","days":30}'

# Verify a license
curl "https://great10.xyz/api/licenses/GT10-XXXX-XXXX-XXXX-XXXX/verify?domain=testsite.com"
```

## Support

For support, contact us at support@great10.xyz