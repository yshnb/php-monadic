<?php

namespace Monadic\Either;

use Monadic\Either;

final class Left extends Either
{
	static public function unit($value)
	{
		return new Left($value);
	}
}
