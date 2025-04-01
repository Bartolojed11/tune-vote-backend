# Laravel Application Setup Guide

## Prerequisites

Ensure you have the following installed on your system:

-   PHP (>=8.0)
-   Composer
-   MySQL or PostgreSQL
-   Node.js & npm
-   Redis (optional, if used in the project)

## Installation Steps

1. **Clone the repository**

    ```bash
    git clone https://github.com/Bartolojed11/tune-vote-backend.git
    cd tune-vote-backend
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

3. **Set up environment file**

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials and other necessary configurations.

4. **Generate application key**

    ```bash
    php artisan key:generate
    ```

5. **Run database migrations and seeders**

    ```bash
    php artisan migrate --seed
    ```

6. **Start the Laravel development server**

    ```bash
    composer run dev
    ```

## Spotify API Integration

This application COULD fetch the latest album releases using the Spotify API. To enable this feature:

1. Register on [Spotify Developer Portal](https://developer.spotify.com/).
2. Get your `client_id` and `client_secret`.
3. Add the following in your `.env` file:
    ```env
    SPOTIFY_CLIENT_ID=your_client_id
    SPOTIFY_CLIENT_SECRET=your_client_secret
    ```

### Using Spotify API in Seeder

The seeder COULD fetch real album data using the Spotify API.

#### Sample Usage:

```php
$service = app(App\Services\Music\Client\NewReleaseClient::class);
$response = $service->get(offset: 0, $limit: 10);
```

Modify the seeder to loop through the response and insert data into the database.

Run the seeder manually using:

```bash
php artisan db:seed
```

## Additional Commands

-   Run queue workers (if applicable):
    ```bash
    php artisan queue:work
    ```
-   Clear cache:
    ```bash
    php artisan cache:clear
    php artisan config:clear
    ```
    ```

    ```

## License

This project is licensed under the MIT License.
