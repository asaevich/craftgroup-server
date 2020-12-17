# Установка 

Установить все необходимы зависимости

```shell
composer install
```

Настроить подключение к базе данных, задав необходимые параметры в файле
```text
 config/database.php
```
Применить миграции

```shell
vendor\bin\phinx migrate
```

Заполнить базу данных начальными данными

```shell
vendor\bin\phinx seed:run
```

Запустить встроенный веб-сервер

```shell
php -S localhost:80 -t public/
```




