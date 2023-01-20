# Guide
## Steps
1. composer install
2. php artisan key:generate
3. cp .env.example .env
4. add database info in .ENV (My DB name: i_cloud_lms)
5. set QUEUE_CONNECTION=database
6. php artisan migrate
7. php artisan queue:work