# Couple

```php
// Gets the class.
$couple = new ht2\couple\Couple();

// Creates the arguments.
$modifier = function ($needle, $haystack) {
  return $needle;
};
$needle = [];
$haystack = [];

// Runs the couple.
$couple->run($needle, $haystack, $modifier);
```
