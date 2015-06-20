<?php

namespace Monadic;

interface Functor
{
	public function fmap($callable);
}
