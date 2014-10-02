# Validate

```php
$validate = new $validate->couple();

$validate->couple([
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello world',
  'array' => [20],
  'string2' => function ($needle, $haystack) {
    $needle === 'foobar';
  }
])([
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello world',
  'array' => [20],
  'string2' => 'foobar'
]); // Returns true.

$validate->couple([
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello uk',
  'array' => [20],
  'string2' => function ($needle, $haystack) {
    $needle === 'foobar';
  }
])([
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello world',
  'array' => [20],
  'string2' => 'foobar'
]); // Throws ValidationException with the message "`string1` is not valid".
```
