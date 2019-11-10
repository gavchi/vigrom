# Тестовое задание Vigrom corp.

###Требования
* Apache or nginx
* php 7.2.0 +
* mysql 5.6 +

Детальные требования к серверу:
https://laravel.com/docs/master/installation#server-requirements

Для Apache в DocumentRoot вашего VirtualHost должен быть путь к папке проекта /public

Для nginx в секции location в опции root должен быть путь к папке проекта /public

В корневой папке выполнить `composer install`

Файл `.env.example` переименовать в `.env` 
и указать свои параметры для соединения с предварительно созданной базой данных в опциях
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Далее последовательно выполнить команды:

`php artisan migrate`

`php artisan db:seed`

База будет заполнена тестовыми даннымы, после чего можно начинать проверку

## API

**Кошелек**

Баланс кошелька
``` http
GET /api/wallet/{id}
{id} - целочисельный идентификатор кошелька
```

**Транзакции**

Создание транзакции
``` http
POST /api/transaction

Передаваемые параметры:
wallet_id (int) - идентификатор кошелька
currency_id (int) - идентификатор валюты
type (string) - тип транзакции (debit или credit)
amount (float) - сумма, на которую нужно изменить баланс
cause (string) - причина изменения счета (например: stock, refund)
```

##Bonus
SQL запрос, который вернет сумму, полученную по причине refund за последние 7 дней:

По всем пользователям и типам транзакций
``` mysql
SELECT SUM(`amount`) FROM `transactions` WHERE `cause` = 'refund';
```

По всем пользователям и типу транзакций credit
``` mysql
SELECT SUM(`amount`) FROM `transactions` WHERE `cause` = 'refund' AND `type` = 'credit';
```

По пользователям и типу транзакций credit
``` mysql
SELECT `users`.`id`, SUM(`transactions`.`amount`) 
FROM `transactions` 
LEFt JOIN `wallets` ON `transactions`.`wallet_id` = `wallets`.`id`
LEFt JOIN `users` ON `wallets`.`user_id` = `users`.`id`
WHERE `cause` = 'refund' AND `type` = 'credit'
GROUP BY `users`.`id`
;
```
