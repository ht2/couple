# Merge

```php
// Gets the class.
$couple = new couple\Merge();

// Creates the arguments.
$needle = [
  'a' => 1,
  'b' => 1
];
$haystack = [
  'b' => 2,
  'c' => 2
];

// Runs the couple.
$couple->run($haystack, $needle);

/*
Returns `[
  'a' => 1,
  'b' => 1,
  'c' => 2
]
*/
```
