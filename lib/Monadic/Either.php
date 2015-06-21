<?php

namespace Monadic;

use Monadic\Either\Left;
use Monadic\Either\Right;

abstract class Either implements Monad, Functor
{
	protected $left;

	protected $right;

	public function __construct($value)
	{
		if ($this instanceof Left) {
			$this->left = $value;
		} elseif ($this instanceof Right) {
			$this->right = $value;
		}
	}

	public function left($callable)
	{
		if ($this instanceof Left) {
			return $callable($this->left);
		} else {
			return $this;
		}
	}

	public function right($callable)
	{
		if ($this instanceof Right) {
			return $callable($this->right);
		} else {
			return $this;
		}
	}

	public function bind($callable)
	{
		if ($this instanceof Left) {
			return $this->left($callable);
		} elseif ($this instanceof Right) {
			return $this->right($callable);
		}
	}

	public function fmap($callable)
	{
		if ($this instanceof Left) {
			$this->left = $callable($this->left);
		} elseif ($this instanceof Right) {
			$this->right = $callable($this->right);
		}

		return $this;
	}

	public function fmapRight($callable)
	{
		if ($this instanceof Right) {
			$this->right = $callable($this->right);
		}

		return $this;
	}

	public function fmapLeft($callable)
	{
		if ($this instanceof Left) {
			$this->left = $callable($this->left);
		}

		return $this;
	}

	public function get()
	{
		if ($this instanceof Left) {
			return $this->left;
		} elseif ($this instanceof Right) {
			return $this->right;
		}
	}
}
