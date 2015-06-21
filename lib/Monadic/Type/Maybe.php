<?php

namespace Monadic\Type;

use Monadic\Type\Maybe\Just;
use Monadic\Type\Maybe\Nothing;

use Monadic\TypeInterface\Functor;
use Monadic\TypeInterface\Monad;

abstract class Maybe extends Identity implements Monad, Functor
{
	static public function unit($value = null)
	{
		if (isset($value)) {
			return new Just($value);
		} else {
			return new Nothing();
		}
	}

	public function bind($callable)
	{
		if ($this instanceof Just) {
			return $callable($this->value);
		} else {
			return $this;
		}
	}

	public function fmap($callable)
	{
		if ($this instanceof Just) {
			return Maybe::unit($callable($this->value));
		} else {
			return $this;
		}
	}
}
