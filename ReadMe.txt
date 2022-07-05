composer install --ignore-platform-reqs


install horizon this way :
$ composer require laravel/horizon --ignore-platform-reqs
then run
$ php artisan horizon:install
$ composer install --ignore-platform-reqs
pcntl extension is not supported on Windows. (based on your XAMPP information)



https://laravel.com/docs/8.x/filesystem

For anyone else who gets stuck at this point, see: https://docs.laravel-excel.com/3.1/exports/export-formats.html for PDF writer options.

Or you can use "composer require dompdf/dompdf" if you're unsure as to which one to use.