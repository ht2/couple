# Field
Field provides some utility functions for validation allowing for defaults, optional fields, and states.

```php
// Gets the classes.
$couple = new couple\Validate();

// Creates the arguments.
$string1 = (new couple\Field())
  ->setOptional(true)
  ->setStates(['hello', 'world'])
  ->setDefault('hello');
$needle = [
  'boolean' => false,
  'integer' => 10,
  'double' => 10.0,
  'string1' => $string1,
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
$haystack['string1'] = 'world';

// Runs the couple.
$couple->run($haystack, $needle); // Returns true.

// Changes the haystack.
$haystack['string1'] = 'hello world';

// Runs the couple.
$couple->run($haystack, $needle); // Throws TypedCoupleException with the message "`string1` is not valid".
```
