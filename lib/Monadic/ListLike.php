<?php

namespace Monadic;

use Monadic\Identity;

class ListLike extends Identity implements Monad, Functor, \ArrayAccess, \Iterator
{
	private $position;

	static public function unit($value = null)
	{
		// to apply multiple parameters, create object with ReflectionClass
		$args = func_get_args();
		return (new \ReflectionClass("Monadic\ListLike"))->newInstanceArgs($args);
	}

	public function __construct($value = null)
	{
		$this->value = func_get_args();
	}

	public function bind($callable)
	{
		$flatten = array();
		foreach ($this->value as $elem) {
			foreach ($callable($elem) as $item) {
				array_push($flatten, $item);
			}
		}
		
		return (new \ReflectionClass($this))->newInstanceArgs($flatten);
	}

	public function fmap($callable)
	{
		$preFlat = array();
		foreach ($this->value as $elem) {
			array_push($preFlat, $callable($elem));
		}
		
		$reflect = new \ReflectionClass("Monadic\ListLike");
		return $reflect->newInstanceArgs($preFlat);
	}

	public function offsetSet($offset, $value)
	{
		$this->value[$offset] = $value;
	}

	public function offsetExists($offset)
	{
		return isset($this->value[$offset]);
	}

	public function offsetUnset($offset)
	{
		unset($this->value[$offset]);
	}

	public function offsetGet($offset)
	{
		return $this->value[$offset];
	}

	public function rewind()
	{
		$this->position = 0;
	}

	public function current()
	{
		return $this->value[$this->position];
	}

	public function key()
	{
		return $this->position;
	}

	public function next()
	{
		++$this->position;
	}

	public function valid()
	{
		return isset($this->value[$this->position]);
	}

}
