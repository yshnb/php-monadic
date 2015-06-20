<?php

namespace Monadic;

use Monadic\Either\Left;
use Monadic\Either\Right;

abstract class Either extends Identity implements Monad, Functor
{
	public function left($callable)
	{
		if ($this instanceof Left) {
			return $callable($this->value);
		} else {
			return $this;
		}
	}

	public function right($callable)
	{
		if ($this instanceof Right) {
			return $callable($this->value);
		} else {
			return $this;
		}
	}

	public function bind($callable)
	{
		return $callable($this->value);
	}

	public function fmap($callable)
	{
		$this->value = $callable($this->value);

		return $this;
	}
}
