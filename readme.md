## Установка

Для работы требуется php7+.

Клонируем проект:<br> 
<code>git clone https://github.com/pawwwloff/laravelTest.git</code>

Устанавливаем зависимости: <br>
<code>composer install</code><br>

Копируем файл .env.example и сохраняем с именем .env, после чего в нем устанавливаем параметры подключения к базе.

После этого запускаем миграции и сиды:<br>
<code>php artisan migrate</code><br>
<code>php artisan db:seed</code><br>
