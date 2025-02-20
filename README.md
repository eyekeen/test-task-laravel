Larave 9
Bootstrap 5
sqlite

## setup

Установка зависимостей
```
composer install
```

Переменные окружения
```
cp .env.example .env
```

```
php artisan key:generate
```

Выполняем миграции
```
php artisan migrate
```

Заполняем базу данными
```
php artisan db:seed
```

Запускаем сервер и сюда http://127.0.0.1:8000
```
 php artisan serve
```
