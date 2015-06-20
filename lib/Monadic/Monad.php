<?php

namespace Monadic;

interface Monad 
{

	static public function unit($value);

	public function bind($callable);

}
