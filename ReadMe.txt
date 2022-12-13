-job is a task that runs in the background and executed by the framework

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



workers

$ php artisan queue:work

$ php artisan queue:restart

-retry a specific job
$ php artisan queue:retry uuid

-retry all the jobs
$ php artisan queue:retry all

$ php artisan queue:work --tries=3

-how manny secs it should wait until another try
$ php artisan queue:work --tries=3 --backoff=3

-firing multiple jobs at the same time
-two ways to group jobs -> batch and chaining
-firing at the same time -> batching
-firing one after the other -> chaining


$ php artisan queue:work --queue=priority,default

$ php artisan queue:listen

-redis works well with laravel horizon

install
-predis/predis
-make a change in the config to predis


Laravel Report Generator Package