# Couple

```php
$mod = function ($needle, $haystack) {
  return $needle;
};
$needle = [];
$haystack = [];

$coupleResult = couple\couple($mod);
$coupleResult = $coupleResult($needle);
$coupleResult = $coupleResult($haystack);
```
