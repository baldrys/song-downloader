# Desctiption

Single page application that allows to download songs.

It's based on `laravel` and `vue` and uses `youtube api` and `youtube-dl` to find and download songs accordingly.

### Requirements:

`youtube-dl, ffmpeg, python`

## Steps

1. Clone project
2. Install dependencies `composer update`
3. Copy `.env.example` and rename it to `.env`
4. Update `.env` accordigly to your settings
5. Generate application key `php artisan key:generate`
6. Run migrations `php artisan migrate`
7. Run server (for example `php artisan serve`)
8. Run workers `php artisan queue:work`
9. Install front-end packages `npm install`
10. Make link to back end storage

```
mkdir storage/app/public/downloads
php artisan storage:link
```

## Docker

You can use `docker-compose.yml` file to avoid incompatibility problems.

In that case installation steps are the same.

### Example

![](images/Screenshot.png)
