<?php

namespace Monadic\Either;

use Monadic\Either;

final class Right extends Either
{
	static public function unit($value)
	{
		return new Right($value);
	}
}
