<h3>Тестовый сервис для хранения и подачи объявлений</h3>

Установка:

1) git clone <URL текущего репозитория>
2) cd test
3) composer update --ignore-platform-reqs
4) указать данные для подключения к БД в файле .env
5) Создать БД с названием test
6) php artisan migrate
7) npm update
8) php artisan serve
9) npm run watch Внимание! Запустить команду нужно в дополнительном окне консоли, не закрывая консоль из предыдущих шагов
То есть необходимо вновь в консоли открыть папку с проектом и выполнить вышеописанную команду

После всех выполненных шагов должен открыться браузер с сервисом
