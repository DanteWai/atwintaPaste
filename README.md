
## AWESOME-PSTB
Тестовое задание

Front Vue3
Backend laravel

Тестовые данные
>php artisan db:seed

Аутентификация через Laravel Sanctum, дополнительные настройки вынесены в env.example, 
если ауктуальный домен указать неверно, даже при удачной аутентификация, после следующего запроса она сбросится

>SANCTUM_STATEFUL_DOMAINS=localhost:8000,localhost:3000,localhost
> 
>SESSION_DOMAIN=localhost
