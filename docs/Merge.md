# Merge

```php
$merge = new Merge();

$merge->couple([
  'a' => 1,
  'b' => 1
])([
  'b' => 2,
  'c' => 2
]);

/*
Returns `[
  'a' => 1,
  'b' => 1,
  'c' => 2
]
*/
```
