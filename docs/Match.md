# Match

```php
$match = new Match();

$match->couple([
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
```
