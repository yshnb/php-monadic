<?php

namespace Monadic\TypeInterface;

interface Group extends Monoid
{
	public function inverse();
	
	public function isInverse($object);
}
