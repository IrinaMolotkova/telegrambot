# Встановлюємо офіційний образ PHP з Apache
FROM php:8.2-apache

# Копіюємо всі файли до контейнера
COPY . /var/www/html/

# Відкриваємо порт 80
EXPOSE 80
