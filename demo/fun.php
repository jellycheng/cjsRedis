<?php

if ( ! function_exists('env')) {

	function env($key, $default = null)
	{
		$value = getenv($key);

		if ($value === false) return value($default);

		switch (strtolower($value))
		{
			case 'true':
			case '(true)':
				return true;

			case 'false':
			case '(false)':
				return false;

			case 'null':
			case '(null)':
				return null;

			case 'empty':
			case '(empty)':
				return '';
		}

		return $value;
	}
}
if ( ! function_exists('value')) {
	function value($value)
	{
		return $value instanceof \Closure ? $value() : $value;
	}
}

