<?php

namespace Monadic\Type\Either;

use Monadic\Type\Either;

final class Right extends Either
{
	static public function unit($value)
	{
		return new Right($value);
	}
}
