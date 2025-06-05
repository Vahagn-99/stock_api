# 📦 Stock API

REST API приложение для справочника **Организаций**, **Зданий** и **Деятельности**.  
Проект завернут в Docker и документирован с помощью Swagger.

## 🚀 Быстрый старт

### 1. Клонирование репозитория

```bash
1. git clone https://github.com/Vahagn-99/stock_api.git stock_api

2. cd stock_api
```

### 2. Настройка переменных окружения

Скопируйте `.env.example` в `.env` и задайте параметры:

```bash
cp .env.example .env
```

### 3. Запуск контейнеров

```bash
docker-compose up -d --build
```

### 4. Установка зависимостей, миграции и сидеры

```bash
1. docker exec -it stock.app /bin/zsh

2. composer install

3. php artisan migrate --seed

```

### 5. Генерация API токена

```bash
php artisan new:access_token --user_id=1
```

Если ID пользователя не указан — используется первый доступный.

---

## 🔐 Авторизация

Все запросы к API требуют заголовок:

```
Authorization: Api-Key {ваш_токен}
```

---

## 🧪 Swagger UI

Документация доступна по адресу:

```
http://localhost/api/documentation
```

---

## 📚 Основной функционал

- Получение организаций по зданию или деятельности
- Геопоиск организаций
- Поиск по названию и виду деятельности (с учетом вложенности)
- Список всех зданий
- Просмотр организации по ID