<?php

namespace Aliem\Memoize\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed remember(string $key, Closure $callback)
 * @method static void put(string $key, string $value)
 * @method static mixed get(string $key)
 * @method static bool has(string $key)
 * @method static bool forget(string $key)
 * @method static void flush(string $key)
 *
 * @see \Aliem\Memoize\Memoize
 */
class Memoize extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'memoize';
	}
}
