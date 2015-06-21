<?php

namespace Monadic\TypeInterface;

interface Functor
{
	public function fmap($callable);
}
