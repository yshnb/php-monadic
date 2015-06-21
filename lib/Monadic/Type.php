<?php

namespace Monadic;

abstract class Type
{
	static public function isTypeElement($object)
	{
		return ($object instanceof Type);
	}
}
