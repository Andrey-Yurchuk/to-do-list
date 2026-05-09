# To-Do-List API

REST API для управления задачами: создание, просмотр списка, просмотр одной задачи, обновление и удаление.

## Стек

- PHP 8.4
- Laravel 13
- Laravel Octane + FrankenPHP (Caddy)
- MySQL 8.4
- Docker Compose
- PHPUnit
- PHPStan (Larastan)
- Laravel Pint
- Swagger UI + OpenAPI 3.1

## Быстрый запуск

1. Клонировать репозиторий и перейти в каталог проекта:

```bash
git clone https://github.com/Andrey-Yurchuk/to-do-list.git
cd to-do-list
```

2. Скопировать переменные окружения:

```bash
cp .env.example .env
```

3. Установить зависимости Composer в контейнере:

```bash
docker compose run --rm app composer install
```

4. Собрать и запустить контейнеры:

```bash
docker compose build
docker compose up -d
```

5. Выполнить миграции и сиды:

```bash
docker compose exec app php artisan migrate --force
docker compose exec app php artisan db:seed --force
```

## Доступные URL

- Главная (редирект): `http://127.0.0.1:8080/` -> `/health`
- Health check: `http://127.0.0.1:8080/health`
- Swagger UI: `http://127.0.0.1:8080/docs`

## Полезные команды

Проверка стиля:

```bash
composer lint
```

Автоформатирование:

```bash
composer format
```

Статический анализ:

```bash
composer phpstan
```

Тесты:

```bash
composer test
```

Остановка контейнеров:

```bash
docker compose down
```
