# Couple

```php
// Gets the class.
$couple = new couple\Couple();

// Creates the arguments.
$modifier = function ($needle, $haystack) {
  return $needle;
};
$needle = [];
$haystack = [];

// Runs the couple.
$couple->run($needle, $haystack, $modifier);
```
