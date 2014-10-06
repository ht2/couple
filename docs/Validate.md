# Validate

```php
// Gets the class.
$couple = new couple\Validate();

// Creates the arguments.
$needle = [
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello world',
  'array' => [20],
  'string2' => function ($needle, $haystack) {
    $needle === 'foobar';
  }
];
$haystack = [
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => 'hello world',
  'array' => [20],
  'string2' => 'foobar'
];

// Runs the couple.
$couple->run($haystack, $needle); // Returns true.

// Changes the haystack.
$haystack['string1'] = 'hello uk';

// Runs the couple.
$couple->run($haystack, $needle); // Throws TypedCoupleException with the message "`string1` is not valid".
```
