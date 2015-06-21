<?php

namespace Monadic\ValueClass;

use Monadic\Type;
use Monadic\TypeInterface\Equivalence;

final class Bool extends Type implements Equivalence
{
	private $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	static public function equal($a, $b)
	{
		if (Bool::isTypeElement($a) && Bool::isTypeElement($b)) {
			return false;
		}

		return $a->equals($b);
	}

	static public function isTypeElement($object)
	{
		return ($object instanceof Bool);
	}

	public function equals(Bool $obj)
	{
		return ($this->value == $obj->value);
	}

}
