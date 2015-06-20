<?php

namespace Monadic;

interface Monad 
{

	static public function unit();

	public function bind($callable);

	public function get();

}
