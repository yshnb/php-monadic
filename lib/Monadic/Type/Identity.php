<?php

namespace Monadic\Type;

use Monadic\TypeInterface\Functor;
use Monadic\TypeInterface\Monad;

class Identity implements Monad, Functor
{
	protected $value;

	static public function unit($value)
	{
		return new self($value);
	}

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function bind($callable)
	{
		return $callable($this->value);
	}

	public function fmap($callable)
	{
		return Identity::unit($callable($this->value));
	}

	public function get()
	{
		return $this->value;
	}
}
