<?php

namespace Monadic\TypeInterface;

interface Monad 
{

	static public function unit($value);

	public function bind($callable);

}
