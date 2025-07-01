# Rebox payments API PHP-SDK

PHP SDK модуль для интеграции платежной системы Rebox (RBX).

## Установка и подключение

Установка с помощью [composer](https://getcomposer.org/download/):

```bash
$ composer require rbx/rbx-php-sdk
```

## Документация

**Описание всех доступных API методов к платежной системе RBX**: https://api.rebox.pro/doc


## Авторизация

**Для использования SDK требуется `SERIAL` и `SECRET_KEY`.**<br>
**Данные API-ключи вы можете получить в своем личном кабинете:** https://rebox.pro

```php
<?php

$serial = 'ca185e41e4fd6cca0249236ade373f138cbd21e845a5c20029ba5e75fc854a9f';
$secretKey = 'LS0tLS1CRUdJTiBQUklWQVRFIEtFWS0tLS0tCk1JSHVBZ0VBTUJBR0J5cUdTTTQ5QWdFR0JTdUJCQUFqQklIV01JSFRBZ0VCQkVJQXYxVGhzbGNvV3lxUlV5cEwKTXF2MGhWUjVxSytUZTkvTzVEeHFCZHRwZTBSZDRGMHBYY0F3R0dqeFpabEdvQjFoUEFJWDhvdG5hNU9MVTBUZQptd3U4QWFpaGdZa0RnWVlBQkFGNi9VUWsyamM5K3A2SVFlRmtDcCtKZm5WNGtMdU1WNytqekZyZ1VpQzd0bUlyCmcvcnJjeGhKTmdFT1hTZndBRzFjOU5SbE1BYzgyZDQyWWUxT0RQc0svd0hWa0YwUDlPVE1PUDgvS05iYjRHOUsKa3ZFNEZNRUZnbCtzUnROZi93cEFJK2gxOC9peU0zRzVoeDFHdUR3Rm5reEk5Q01SbG1hd01hUk54SEJqcEFWMgpWdz09Ci0tLS0tRU5EIFBSSVZBVEUgS0VZLS0tLS0K';

$apiClientRBX = new \RBX\client\RBXApiClient($serial, $secretKey);

?>
```

## Примеры использования
**После авторизации вам доступно несколько коллекций API Endpoint-ов**
- client()
- reference()
- paymentIn()
- paymentOut()

**Каждая коллекция имеет перечень публичных методов.** <br>
**Коллекция client()**
```php
<?php

// Получение списка кошельков
$walletListDto = $apiClientRBX->client()->getWalletList();

// Получение баланса рублевого счета
$currencyId = 1; // Идентификатор валюты
$balanceDto = $apiClientRBX->client()->getBalance($currencyId); 

?>
```

**Коллекция reference()**
```php
<?php

// Получение списка валют
$currencyListDto = $apiClientRBX->reference()->getCurrencyList();

?>
```

**Коллекция paymentIn()**
```php
<?php

// Получение информации о входящем платеже
$uid = 'efhsdf3294'; // UID/RNN платежа
$apiClientRBX->paymentIn()->getPaymentInfo($uid);

// Получение доступных методов входящего платежа
$currencyId = 1; // Идентификатор валюты
$apiClientRBX->paymentIn()->getMethodList($currencyId);

// Получение адреса криптовалюты, с помощью которого можно пополнить счет в RBX
$methodId = 11; // Идентификатор метода платежа
$apiClientRBX->paymentIn()->getCryptoAddress($methodId);

?>
```


**Коллекция paymentOut()**

**В данной коллекции упоминается такой параметр, как ChainUID. <br>**
**Данный параметр нужен для отслеживания цепочки платежей, которая может возникнуть при попытке вывести крупную сумму, превышающую максимальный порог платежа. <br>** 
**Система сама контролирует процесс разбиение крупного платежа на несколько, меньшего размера, удовлетворяющих внутренним требованиям платежной системы.** 

```php
<?php

// Получение списка доступных методов вывода средств
$currencyId = 1; // Идентификатор валюты
$methodListDto = $apiClientRBX->paymentOut()->getMethodList($currencyId);

// Получение необходимых параметров исходящего платежа
$methodId = 11;
$paymentFieldsDto = $apiClientRBX->paymentOut()->getPaymentFields($methodId);


// Запрос на вывод средств из платежной системы RBX
$methodId = 11; // Метод платежа на вывод средств
$amount = 2000; // Сумма платежа
// Параметры платежа
$paymentFields = [
    'account' => '1234 1234 1234 1234' // Номер карты, полученный из метода paymentFields
];

$paymentOutDto = $apiClientRBX->paymentOut()->payment($methodId, $amount, $paymentFields);

// Получение информации о цепочки платежей 
$chainUid = 'fdsfoejr123'; // UID цепочки платежей
$chainPaymentDto = $apiClientRBX->paymentOut()->getChainPaymentInfo($chainUid);

// Получение информации об исходящем платеже
$uid = 'efhsdf3294'; // UID/RNN входящего платежа
$paymentDto = $apiClientRBX->paymentOut()->getPaymentInfo($uid);

?>
```

## Требования

* **PHP v7.4.0** или выше
* расширение PHP **json**
* расширение PHP **curl**
* расширение PHP **openssl**

## Лицензия

[MIT](LICENSE.md)