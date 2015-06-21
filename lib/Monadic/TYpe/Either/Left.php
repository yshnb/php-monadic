<?php

namespace Monadic\Type\Either;

use Monadic\Type\Either;

final class Left extends Either
{
	static public function unit($value)
	{
		return new Left($value);
	}
}
