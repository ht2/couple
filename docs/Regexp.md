# Regexp
Unfortunately this wrapper is needed for any regular expressions (it uses preg_match).

```php
// Gets the class.
$couple = new couple\Match();

// Creates the arguments.
$needle = [
  'string1': 'Hello world'
];
$haystack = [
  'string1' => new couple\Regexp('#Hello world#')
];

// Runs the couple.
$couple->run($haystack, $needle); // Returns true.
```
