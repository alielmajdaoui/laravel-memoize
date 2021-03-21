# Laravel Memoize

Memoize your expensive computed values to use in different components per each request.

## Use case

Suppose you have an `AddCommentRequest` class whose job is to validate comments being added to your blog posts.

During the validation, you might need to make a database query using an Eloquent model or directly using the `DB` facade, and the same query result might be needed in the near future in another app component, say in your `CommentController` where this Request class is being called(injected) from.

If you do the same query from those 2 different places, you will end up with duplicate queries, and here where `laravel-memoize` comes to the rescue. It's to simple, just wrap the query in a `\Closure` and it will be memoized for you.

# Installation

Install with composer

```shell
composer require aliem/laravel-memoize
```

# Usage

You can memoize a heavy computed value by using the method `remember(string $key, \Closure $callback)` from `Aliem\Memoize\Facades\Memoize` facade.

## Example

```php
<?php

namespace App\Controllers;

use Aliem\Memoize\Facades\Memoize;

class MyAwesomeController extends Controller {
    public function index() {
        
        // Check if the item `iam_heavy` is memoized and return it,
        // otherwise, run the \Closure and memoize the result.
        $value = Memoize::remember('iam_heavy', function() {
            $result = 0;

            for ($i = 0; $i < 1000000; $i++) {
                $result += $i * rand(1, 10);
            }

            return $result;
        });

        return response(sprintf("My memoized value: %s", $value));
    }
}
```

### remember(string $key, \Closure $callback): mixed

Check if the item is memoized, or it will execute the `\Closure` and memoize the result.

```php
Memoize::remember(string $key, \Closure $callback);
```

#### Example

```php
<?php

use Aliem\Memoize\Facades\Memoize;

$comment = Memoize::remember('comment:1', function() {
    return Comment::find(1);
});
```

### get(string $key): mixed

Get a memoized item

```php
Memoize::get(string $key);
```

#### Example

```php
<?php

use Aliem\Memoize\Facades\Memoize;

$comment = Memoize::get('comment:1');
```

### put(string $key, mixed $value): void

Memoize an item

```php
<?php

use Aliem\Memoize\Facades\Memoize;

$result = Comment::find(1);
$comment = Memoize::put('comment:1', $result);
```

### has(string $key): bool

Check if an item is memoized

```php
<?php

use Aliem\Memoize\Facades\Memoize;

if (Memoize::has('comment:1')) {
    echo 'the item `comment:1` is memoized';
}
```

### forget(string $key): bool

Delete a memoized item.

```php
<?php

use Aliem\Memoize\Facades\Memoize;

Memoize::forget('comment:1');
```

## Memoize::flush()

Delete all memoized items

```php
<?php

use Aliem\Memoize\Facades\Memoize;

Memoize::flush();
```

## License

MIT.