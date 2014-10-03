# TypedCouple

```php
// Defines your own `TypedCouple`.
class ShallowMerge extends couple\TypedCouple {
  // Override methods from `TypedCouple` if you need to.

  // Define abstract methods in `TypedCouple`.
  public function primitive($needle, $haystack) {
    return $haystack;
  }

  public function arr($needle, $haystack) {
    return $haystack;
  }

  public function unknown($needle, $haystack) {
    return $haystack;
  }
}

// Creates the arguments.
$shallowMerge = new ShallowMerge();
$needle = [
  'a' => 1,
  'b' => 1
];
$haystack = [
  'b' => 2,
  'c' => 2
];

// Runs your `TypedCouple`.
$coupleResult = $shallowMerge->run($needle, $haystack);

/*
Returns `[
  'a' => 1,
  'b' => 1,
  'c' => 2
]`
*/
```
