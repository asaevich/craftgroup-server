# Установка 

Установите все необходимы зависимости

```shell
composer install
```

Настройте подключение к базе данных, задав необходимые параметры в файле
```text
 config/database.php
```
Примените миграции

```shell
vendor\bin\phinx migrate
```

Заполните базу данных начальными данными

```shell
vendor\bin\phinx seed:run
```

Запустите встроенный веб-сервер

```shell
php -S localhost:80 -t public/
```
