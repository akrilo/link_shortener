# Установка и запуск приложения URL Shortener

Это простое веб-приложение для сокращения URL-адресов, написанное с использованием Symfony и MySQL.

## Требования

Перед началом установки у вас должны быть установлены следующие компоненты:

- [XAMPP](https://www.apachefriends.org/index.html) - для установки и запуска сервера Apache, MySQL и PHP.
- [Composer](https://getcomposer.org/download/) - для управления зависимостями PHP.
- [Symfony CLI](https://symfony.com/download) - для запуска веб-сервера Symfony и управления Symfony-приложением.

### Установка XAMPP

1. Скачайте XAMPP с официального сайта: [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).
2. Запустите установочный файл и следуйте инструкциям мастера установки.
3. После установки запустите XAMPP Control Panel и запустите Apache и MySQL.

### Установка Composer

1. Скачайте Composer с официального сайта: [https://getcomposer.org/download/](https://getcomposer.org/download/).
2. Запустите установочный файл и следуйте инструкциям мастера установки.
3. После установки убедитесь, что путь к исполняемому файлу Composer добавлен в системную переменную PATH.

### Установка Symfony CLI

1. Откройте браузер и перейдите на страницу загрузки Symfony CLI: [https://symfony.com/download](https://symfony.com/download)
2. Следуйте инструкциям для загрузки и установки Symfony CLI в соответствии с вашей операционной системой.

## Запуск приложения

1. Склонируйте репозиторий с приложением:
    ```
    git clone https://github.com/akrilo/link_shortener.git
    ```
2. Перейдите в директорию проекта:
    ```
    cd link_shortener
    ```
3. Установите зависимости с помощью Composer:
    ```
    composer install
    ```
4. Создайте базу данных MySQL для приложения:
    - Откройте phpMyAdmin в браузере (http://localhost/phpmyadmin).
    - Создайте новую базу данных с именем "link_shortener".
5. Создайте таблицы в базе данных:
    ```
    php bin/console doctrine:schema:update --force
    ```
6. Запустите веб-сервер Symfony:
    ```
    symfony server:start
    ```
7. Откройте браузер и перейдите по адресу [http://localhost:8000](http://localhost:8000) для доступа к приложению.

Теперь вы можете использовать сокращатель URL-адресов!
