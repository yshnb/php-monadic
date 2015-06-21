<?php

namespace Monadic\Type;

use Monadic\Type\Identity;

use Monadic\TypeInterface\Functor;
use Monadic\TypeInterface\Monad;
use Monadic\TypeInterface\Monoid;
use Monadic\TypeInterface\Group;
use Monadic\TypeInterface\Equivalence;

class ListLike extends Identity implements Monad, Functor, Monoid, Group, Equivalence, \ArrayAccess, \Iterator
{
	private $position;

	private $polarity; // positive or negative

	static public function unit($value = null)
	{
		// to apply multiple parameters, create object with ReflectionClass
		$args = func_get_args();
		return (new \ReflectionClass("Monadic\Type\ListLike"))->newInstanceArgs($args);
	}

	static public function add($a, $b)
	{
		if ($a->isInverse($b)) {
			return ListLike::unit();
		}

		$flatten = array();
		foreach ($a as $elem) {
			array_push($flatten, $elem);
		}
		$a->rewind();
		foreach ($b as $elem) {
			array_push($flatten, $elem);
		}
		$b->rewind();

		return (new \ReflectionClass("Monadic\Type\ListLike"))->newInstanceArgs($flatten);
	}

	static public function equal($a, $b)
	{
		return $a->equals($b);
	}

	public function __construct($value = null)
	{
		if (isset($value)) {
			$this->value = func_get_args();
		} else {
			$this->value = array();
		}
		$this->polarity = true;
		$this->rewind();
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
		
		return (new \ReflectionClass($this))->newInstanceArgs($preFlat);
	}

	public function isIdentity()
	{
		return ($this->length() === 0);
	}

	public function length()
	{
		return count($this->value);
	}

	public function equals($object)
	{
		return ($this == $object);
	}

	public function inverse()
	{
		$this->polarity = !$this->polarity;

		return $this;
	}

	public function isInverse($object)
	{
		$_object = clone $object;
		return $this->equals($_object->inverse());
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
