@echo off
echo Запуск Laravel Test API...
echo.
echo Сервер будет доступен по адресу: http://localhost:8000
echo Тестовая страница: http://localhost:8000/test.html
echo API: http://localhost:8000/api/tasks
echo.
echo Для остановки нажмите Ctrl+C
echo.

cd /d "%~dp0"

echo Запускаем встроенный сервер PHP...
php -S localhost:8000 -t public
