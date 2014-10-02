<?php namespace couple;

class Validate extends Match {
  public function array($needle, $haystack) {
    // Matches if the type of the haystack is an array.
    if ($this->type($needle) === $this->type($haystack)) {
      if (count($needle) !== count($haystack)) {
        throw new ValidationException('incorrect number of keys', $needle, $haystack);
      } else {
        // Returns false if the values don't match.
        foreach ($needle as $key => $value) {
          if (!isset($haystack[$key])) {
            throw new ValidationException("$key is undefined", $needle, $haystack);
          } else if (!$this->couple($value)($haystack[$key])) {
            throw new ValidationException("$key is not valid", $needle, $haystack);
          }
        }

        // Returns true because all of the values must have matched.
        return true;
      }
    }

    // Otherwise returns false since the values can't possibly match.
    else {
      throw new ValidationException("expected an array", $needle, $haystack);;
    }
  }
}

class ValidationException extends Exception {
  protected $needle;
  protected $haystack;

  public function __construct($message, $needle, $haystack) {
    // Sets properties for a validation exception.
    $this->needle = $needle;
    $this->haystack = $haystack;

    // Calls the parent's constructor.
    parent::__construct($message);
  }

  public function getNeedle() {
    return $this->needle;
  }

  public function getHaystack() {
    return $this->haystack;
  }
}
