<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Требования
- php >= 5.6.4
- И другие требования к Laravel 5.4: https://laravel.com/docs/5.4/installation
- также требуется установленный Redis

## Установка

1. Склонировать проект
2. composer install
3. Расшарить директории storage, bootstrap/cache (chmod -R 777 storage && chmod 777 bootstrap/cache)
4. Создать бд
5. Создать файл .env (скопировать из .env.example)
6. Сгенерировать ключ (php artisan key:generate)
7. Прописать доступ к бд в .env
8. Накатить миграции (php artisan migrate)

В системе появятся два пользователя: test/123456, test2/123456, у обоих есть файлы.
