## Getting Started

First, run the development server:

```bash
# Start Sail (detached mode)
./vendor/bin/sail up -d

# or, if you have the Sail alias configured
sail up -d

# Copy the environment file
cp .env.example .env

# Install dependencies
sail composer install

# Generate the application key
sail artisan key:generate

# Run migrations and seeders
sail artisan migrate --seed
```
Open http://localhost or laravel.test with your browser to see the result.

If you’ve seeded the database, you can log in with the following credentials:
Email: admin@admin.com
Password: password