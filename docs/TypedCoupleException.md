# TypedCoupleException
This is a class for exceptions raised by TypedCouples.

```php
// Creates the arguments.
$message = 'foo';
$needle = 'bar';
$haystack = 'baz';

// Gets the class.
$exception = new couple\TypedCoupleException($message, $needle, $haystack);

// Demonstrates use of methods.
$exception->getMessage(); // Returns $message.
$exception->getNeedle(); // Returns $needle.
$exception->getHaystack(); // Returns $haystack.
```
