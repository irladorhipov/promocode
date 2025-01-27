## Установка и запуск

Для запуска проекта выполните следующие шаги:

0. **Создание .env**
```
cp .env.local .env
```

1. **Запустите Docker-контейнеры:**
```bash
docker-compose up -d
```

2. **Сгенерируйте ключ приложения:**
```bash
php artisan key:generate
```

3. **Запустите миграции и сидеры:**
```bash
php artisan migrate --seed
```


