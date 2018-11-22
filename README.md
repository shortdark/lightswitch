# lightswitch

Lightswitch creates an array of unique integers when you specify the lowest integer, the highest integer and the volume of integers you require.


## Installation

Install the latest version with

```bash
$ composer require shortdark/lightswitch
```

## Basic Usage

```php
<?php

require_once 'vendor/autoload.php';

$test = new Shortdark\Lightswitch();

$result = $test->press(1,49,7);

var_dump($result);

```

### Author

Neil Ludlow - <neil@shortdark.net> - <https://twitter.com/shortdark>