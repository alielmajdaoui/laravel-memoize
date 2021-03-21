<?php

namespace Aliem\Memoize;

use Closure;

class Memoize
{
	/**
	 * @var array
	 */
	protected static $values = [];

	/**
	 * Get a memoized item, or execute the given Closure and store the result.
	 *
	 * @param  string  $key
	 * @param  \Closure  $callback
	 * @return mixed
	 */
	public static function remember($key, Closure $callback)
	{
		$value = self::get($key);

		if (!is_null($value)) {
			return $value;
		}

		self::put($key, $value = $callback());

		return $value;
	}

	/**
	 * Memoize an item.
	 *
	 * @param  string  $key
	 * @param  mixed  $value
	 * @return mixed The memoized value.
	 */
	public static function put($key, $value)
	{
		self::$values[$key] = $value;
	}

	/**
	 * Get an item.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public static function get($key)
	{
		if (!array_key_exists($key, self::$values)) {
			return null;
		}

		return self::$values[$key];
	}

	/**
	 * Check if an item is memoized
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public static function has($key)
	{
		return array_key_exists($key, self::$values);
	}

	/**
	 * Forget a specific item.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	public static function forget($key)
	{
		if (array_key_exists($key, self::$values)) {
			unset(self::$values[$key]);

			return true;
		}

		return false;
	}

	/**
	 * Remove all memoized items.
	 *
	 * @return void
	 */
	public static function flush()
	{
		self::$values = [];
	}
}
