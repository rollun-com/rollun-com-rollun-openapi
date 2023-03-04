# Использование сгенерированых клиентов

Информация для тех кто будет использует сгенерированные клиенты.

## Передача массивов в query параметрах

Существует 2 способа передачи массивов в query параметрах при style = form (режим по умолчанию для get запросов). 
См. [спецификацию](https://swagger.io/docs/specification/serialization/#query)

За эти способы отвечает опция explode в манифесте (указывается для каждого парамета отдельно).

Сериализация следующего вида:

| style  | explode | URI template | Primitive value id = 5 | Array id = [3, 4, 5]  | Object id = {"role": "admin", "firstName": "Alex"} |
|--------|---------|--------------|------------------------|-----------------------|----------------------------------------------------|
| form * | true*   | /users{?id*} | /users?id=5            | /users?id=3&id=4&id=5 | /users?role=admin&firstName=Alex                |
| form   | true    | /users{?id}  | /users?id=5            | /users?id=3,4,5       | /users?id=role,admin,firstName,Alex                |

Рассмотрим примеры с параметром filters в query, который является массив строк, для каждого из вариантов.

1. style = form, explode = true

```yaml
- in: query
  name: "filters"
  style: form
  explpde: true
  schema:
    type: array
    items:
      type: string
```

Для того чтобы передать список строк ['string1', 'string2'] под этим ключом нужно передавать массив:

```php
/** @var \OpenAPI\Server\Rest\RestInterface $client */
$client->get(['filters' => ['string1', 'string2']]);
```

В этом случае query строка будет вида ?filters=string1&filters=string2. На серверной стороне добавлена поддержка парсинга таких строк.

2. style = form, explode = false

```yaml
- in: query
  name: "filters"
  style: form
  explpde: false
  schema:
    type: array
    items:
      type: string
```

Для того чтобы передать список строк ['string1', 'string2'] под этим ключом нужно передавать строку с разделителем ",":

```php
/** @var \OpenAPI\Server\Rest\RestInterface $client */
$client->get(['filters' => 'string1,string2']);
```

В этом случае query строка будет вида ?filters=string1,string2. На серверной стороне парсинга таких строк, с последующим преобразованием в массив, поддерживается по умолчанию.

## Конфигурация клиентов
С версии 9.* библиотека поддерживает конфигурирование обьектов Rest\*, Api\*, Configuration и Http клиента. Добавлены соответсвующие фабрики для каждого типа обьектов (кроме Http клиента).

Пример конфигурации api обьекта (например, если нужны разные обьекты с разными хостами):

```php
use OpenAPI\Client\Factory\RestAbstractFactory;
use OpenAPI\Client\Factory\ApiAbstractFactory;
use Test\OpenAPI\V1_0_1\Client\Rest\Test;
use Test\OpenAPI\V1_0_1\Client\Api\TestApi;

return [
    RestAbstractFactory::KEY => [
        'TestClient1' => [
            RestAbstractFactory::KEY_CLASS => Test::class,
            RestAbstractFactory::KEY_API_NAME => 'TestClientApi1'
        ],
        'TestClient2' => [
            RestAbstractFactory::KEY_CLASS => Test::class,
            RestAbstractFactory::KEY_API_NAME => 'TestClientApi2'
        ],
    ],
    ApiAbstractFactory::KEY => [
        'TestClientApi1' => [
            ApiAbstractFactory::KEY_CLASS => TestApi::class,
            ApiAbstractFactory::KEY_HOST_INDEX => 1,
        ],
        'TestClientApi2' => [
            ApiAbstractFactory::KEY_CLASS => TestApi::class,
            ApiAbstractFactory::KEY_HOST_INDEX => 2,
        ],
    ],
];
```

Пример конфигурации Http клиента (например, если нужно увеличить timeout):

```php
use OpenAPI\Client\Factory\ApiAbstractFactory;
use Test\OpenAPI\V1_0_1\Client\Api\TestApi;
use GuzzleHttp\Client;

return [
    ApiAbstractFactory::KEY => [
        'TestClientApi' => [
            ApiAbstractFactory::KEY_CLASS => TestApi::class,
            ApiAbstractFactory::KEY_HOST_INDEX => 1,
            ApiAbstractFactory::KEY_CLIENT => 'TestHttpClient'
        ],
    ],
    // Некая конфигурация для Http клиента
    'dependencies' => [
        'factories' => [
            'TestHttpClient' => function () {
                return new Client(['timeout' => 300]);
            }
        ]
    ]
];
```

## Обробка помилок

### Timeout error

При цій помилці буде викинуто виключення `GuzzleHttp\Exception\ConnectException` с текстом виду "cURL error 28: 
Operation timed out after 1001 milliseconds with 0 bytes received (see https://curl.haxx.se/libcurl/c/libcurl-errors.html)". 
Це виключення ніде не перехоплюється і долетить до клієнтського коду. Відрізнити помилку таймауту від інших помилок 
з'єднання можна, напевно, тільки по тексту помилки. Принаймні я не знайшов як в бібліотеці guzzle їх відрізняти.

```php
<?php
/** @var \HelloUser\OpenAPI\V1\Client\Rest\User $rest */
$rest = $container->get(\HelloUser\OpenAPI\V1\Client\Rest\User::class);

try {
    $result = $rest->post([
        'id' => '1',
        'name' => 'misha'
    ]);
} catch (\GuzzleHttp\Exception\ConnectException $e) {
    // handle here your exception
}
```