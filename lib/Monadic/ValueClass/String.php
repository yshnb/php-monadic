<?php

namespace Monadic\ValueClass;

use Monadic\Type;
use Monadic\TypeInterface\Equivalence;

final class String extends Type implements Equivalence
{
	private $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	static public function equal($a, $b)
	{
		if (String::isTypeElement($a) && String::isTypeElement($b)) {
			return false;
		}

		return $a->equals($b);
	}

	static public function isTypeElement($object)
	{
		return ($object instanceof String);
	}

	public function equals(String $obj)
	{
		return ($this->value == $obj->value);
	}

}
