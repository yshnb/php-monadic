<?php

namespace Monadic\ValueClass;

use Monadic\Type;
use Monadic\TypeInterface\Equivalence;

final class Number extends Type implements Equivalence
{
	private $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	static public function equal($a, $b)
	{
		if (Number::isTypeElement($a) && Number::isTypeElement($b)) {
			return false;
		}

		return $a->equals($b);
	}

	static public function isTypeElement($object)
	{
		return ($object instanceof Number);
	}

	public function equals(Number $obj)
	{
		return ($this->value == $obj->value);
	}

}
