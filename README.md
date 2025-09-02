# Laravel Test API

Простое REST API для управления задачами, построенное на Laravel 11.

## 🚀 Быстрый старт

### 1. Запуск сервера
```bash
# Запуск Laravel сервера
start.bat
```

Или вручную:
```bash
php -S localhost:8000 -t public
```

### 2. Тестирование API
```bash
# Запуск тестов
php test.php
```

### 3. Веб-интерфейс
Откройте в браузере: **http://localhost:8000/test.html**

## 📋 API Endpoints

| Метод | URL | Описание |
|-------|-----|----------|
| GET | `/api/tasks` | Получить все задачи |
| POST | `/api/tasks` | Создать новую задачу |
| GET | `/api/tasks/{id}` | Получить задачу по ID |
| PUT | `/api/tasks/{id}` | Обновить задачу |
| DELETE | `/api/tasks/{id}` | Удалить задачу |

## 📝 Примеры запросов

### Создание задачи
```bash
curl -X POST http://localhost:8000/api/tasks \
  -H "Content-Type: application/json" \
  -d '{"title":"Новая задача","description":"Описание задачи","status":"pending"}'
```

### Получение всех задач
```bash
curl http://localhost:8000/api/tasks
```

### Обновление задачи
```bash
curl -X PUT http://localhost:8000/api/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{"title":"Обновленная задача","status":"completed"}'
```

## 🗄️ База данных

### Настройка базы данных
1. Запустите SQL скрипт: `mysql_setup.sql`
2. Или выполните в MySQL:
```sql
CREATE DATABASE IF NOT EXISTS `api` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `api`;
-- Далее выполните содержимое mysql_setup.sql
```

### Параметры подключения
- **Тип**: MySQL
- **Хост**: mysql-8.0
- **База**: api
- **Пользователь**: root
- **Пароль**: (пустой)

## 📁 Структура проекта

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Controller.php
│   │   └── TaskController.php
│   ├── Models/Task.php
│   ├── Exceptions/Handler.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── RouteServiceProvider.php
├── routes/api.php
├── mysql_setup.sql
├── public/index.php
├── test.php          # Тестирование API
├── test.html         # Веб-интерфейс
└── start.bat         # Запуск сервера
```

## ✅ Статус

- ✅ Laravel 11
- ✅ REST API
- ✅ JSON валидация
- ✅ Обработка ошибок
- ✅ MySQL интеграция
- ✅ CRUD операции

**API готов к использованию!** 🎉