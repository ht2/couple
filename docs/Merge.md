# Merge

```php
$merge = new couple\Merge();

$coupleResult = $merge->couple([
  'a' => 1,
  'b' => 1
]);
$coupleResult = $coupleResult([
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
