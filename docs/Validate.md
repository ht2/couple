# Validate

```php
$validate = new couple\Validate();

$coupleResult = $validate->couple([
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello world',
  'array' => [20],
  'string2' => function ($needle, $haystack) {
    $needle === 'foobar';
  }
]);
$coupleResult = $coupleResult([
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello world',
  'array' => [20],
  'string2' => 'foobar'
]); // Returns true.

$coupleResult = $validate->couple([
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello uk',
  'array' => [20],
  'string2' => function ($needle, $haystack) {
    $needle === 'foobar';
  }
]);
$coupleResult = $coupleResult([
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello world',
  'array' => [20],
  'string2' => 'foobar'
]); // Throws ValidationException with the message "`string1` is not valid".
```
