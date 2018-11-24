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

// All you can do at the moment is to press the lightswitch
// press($lowest_integer, $highest_integer, $how_many_integers)
$result = $test->press(1,49,7);

// You can also specify two different rules, for example,
// 5 integers between 1 and 49, then 2 integers between 1 and 9
$result = $test->press(1,49,5,1,9,2);

// The result will be an array of integers
var_dump($result);

```

### Author

Neil Ludlow - <neil@shortdark.net> - <https://twitter.com/shortdark>