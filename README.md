# php-rgw-api

This lib aims to be a comprehensive PHP SDK for the [Rados Gateway Admin API](http://docs.ceph.com/docs/jewel/radosgw/adminops/).

## Installation
 
This lib is designed to be installed using [Composer](https://getcomposer.org)

```json
{
  "require": {
    "myena/php-rgw-api": "4.*"
  }
}
```

## Features

1. All object-containing responses are modeled ([list](./src/Models))
1. Entire request chain is fully modeled, with required parameters being type-hinted 
(e.g. [UserRootLink::Info](./src/Chain/UserRootLink.php))
1. All models have full [swagger-php](https://github.com/zircote/swagger-php) markup
1. Includes undocumented `/metadata` endpoints
1. Parameter validation ([link](./src/Validator)) with hopefully useful error messages

## Usage Basics

More details on each component can be found below, however here is a quick fill-in-the-blank example:

```php
$config = new \MyENA\RGW\Config([
    'address'   => '',
    'adminPath' => '',
    'apiKey'    => '',
    'apiSecret' => '',
]);
$client = new \MyENA\RGW\Client($config, new \MyENA\RGW\Signature\V2Signature());

[$users, $err] = $client->Metadata()->User()->List()->execute();
if (null !== $err) {
    die((string)$err);
}
var_dump($users);

// and whatever else you wanna do...
```

### Advanced Config

You must first construct a [Config](src/Config.php):

```php
$config = new \MyENA\RGW\Config([
    'address'   => '',  // REQUIRED
    'apiKey'    => '',  // REQUIRED
    'apiSecret' => '',  // REQUIRED

    'adminPath'     => '',  // optional, whatever your admin ops path is

    'silent' => false // optional, silences all logging
]);
```

#### Custom Guzzle Client
The optional 2nd argument in the [Config](src/Config.php) constructor accepts any object implementing the
[Guzzle ClientInterface](https://github.com/guzzle/guzzle/blob/master/src/ClientInterface.php).  If left null, a new 
[Guzzle Client](https://github.com/guzzle/guzzle/blob/master/src/Client.php) with no options will be constructed.

#### Custom Logger
The optional 3rd argument in the [Config](src/Config.php) constructor accepts any object implementing the 
[Psr LoggerInterface](https://github.com/php-fig/log/blob/master/Psr/Log/LoggerInterface.php).  If left null, a new
[Psr NullLogger](https://github.com/php-fig/log/blob/master/Psr/Log/NullLogger.php) will be constructed.
