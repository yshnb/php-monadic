# php-monadic

library for monad pattern in PHP.

## type

this library implements below type (class)

- Identity
- Maybe
- Either
- ListLike(List)

## Usage

### Install

you can install from [packagist.org](https://packagist.org/).

```
composer require yshnb/php-monadic:dev-master
```

## Examples

### Identity

Identity is a monad type, which simply wrap any value.

```
<?php

use Monadic\Identity;

$foo = 1;
$identity = Identity::unit($foo)->bind(function($val) {
    return Identity::unit($val * 2);
});
echo $identity->get(); // 2
```

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

### Either

```
<?php

use Monadic\Either\Right;
use Monadic\Either\Left;

$foo = 1;
$either = Right::unit($foo)->bind(function($val) {
    return Left::unit($val + 1);
})->left(function($val) {
    return Right::unit($val + 1);
})->left(function($val) {
    // not executed
    return Right::unit($val + 1);
});
echo $either->get(); // 3
```

### ListLike

ListLike represents list type (class). Because list is a reserved word in PHP, this type is called ListLike.

```
<?php

use Monadic\ListLike;

$listLike = ListLike::unit(1,2,3);
$listLike = $listLike->bind(function($val) {
    return ListLike::unit($val * 2);
});
echo $listLike[0]; // 3
echo $listLike[1]; // 4
echo $listLike[2]; // 6

```

