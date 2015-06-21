<?php

namespace Monadic\TypeInterface;

interface Monoid
{
	static public function add($a, $b);
	// if something is implemented as monoid, Monoid::add(Monoid::add($a, $b), $c) = Monoid::add($a, Monoid::add($b, $c)) will be formed.

	public function isIdentity();
}
