# TypedCouple

```php
// Defines your own `TypedCouple`.
class ShallowMerge extends TypedCouple {
  // Override methods from `TypedCouple` if you need to.

  // Define abstract methods in `TypedCouple`.
  public function primitive($needle, $haystack) {
    return $haystack;
  }

  public function array($needle, $haystack) {
    return $haystack;
  }

  public function unknown($needle, $haystack) {
    return $haystack;
  }
}

// Runs your `TypedCouple`.
$shallowMerge = new ShallowMerge();
$needle = [
  'a' => 1,
  'b' => 1
];
$haystack = [
  'b' => 2,
  'c' => 2
];
$shallowMerge->couple($needle)($haystack);

/*
Returns `[
  'a' => 1,
  'b' => 1,
  'c' => 2
]`
*/
```
