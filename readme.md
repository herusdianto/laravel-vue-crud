# Laravel & Vue JS CRUD Example

### Install

1. Open your terminal.

2. Clone this repo:

        git clone https://github.com/herusdianto/laravel-vue-crud.git
    
3. Once finished, change directory to laravel-vue-crud:

        cd laravel-vue-crud
    
4. Install all laravel dependencies:

        composer install

5. Copy .env file:

        cp .env.example .env

6. Modify `DB_*` value in `.env` with your database config.

7. Generate application key:

        php artisan key:generate

8. Run migration table:

        php artisan migrate

9. Create a symbolic link:

        php artisan storage:link

10. Serve the app:

        php artisan serve

11. Open `http://localhost:8000/` in your web browser.

### Dummy Data

1. Open your terminal and change directory to `laravel-vue-crud`.

2. Run this command:

        php artisan tinker
    
3. Type this script:

        factory(App\Student::class, 100)->create();
    
4. Hit `Enter`. You can create dummy data as many as you want.

### Development

1. Open your terminal and change directory to `laravel-vue-crud`.

2. Make sure you have [nodejs](https://nodejs.org/en/download/) installed and run this command:

        npm install

3. Make sure you have [bower](https://bower.io/#install-bower) installed and run this command:

        bower install

4. Make sure you have [gulp](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md) installed and run this command:

        gulp watch
    
5. All files (components, etc) are located in `resources/assets`.
    
Check out the demo [here](https://www.youtube.com/watch?v=pRHGYFC5vnk).