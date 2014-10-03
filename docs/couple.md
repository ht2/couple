# Couple

```php
// Gets the class.
$couple = new couple\Couple();

// Creates the arguments.
$mod = function ($needle, $haystack) {
  return $needle;
};
$needle = [];
$haystack = [];

// Runs the couple.
$couple->run($mod, $needle, $haystack);
```
