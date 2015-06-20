<?php

namespace Monadic;

use Monadic\Maybe\Just;
use Monadic\Maybe\Nothing;

abstract class Maybe extends Identity implements Monad, Functor
{
	static public function unit($value)
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
