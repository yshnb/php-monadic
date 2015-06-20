# php-monadic
library for monad pattern in PHP

## usage

### Maybe
```
<?php

use Monadic\Maybe;

$foo = 1;
$maybe = Maybe::unit($foo)->bind(function($val) {
    return Maybe::unit($val + 1);
});
echo $maybe->get(); // 2

$maybe = $maybe->bind(function($val) {
    return Maybe::unit();
});
echo $maybe->get(); // null
```
