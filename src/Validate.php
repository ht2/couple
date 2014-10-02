<?php namespace couple;

class Validate extends Match {
  public function array($needle, $haystack) {
    // Matches if the type of the haystack is an array.
    if ($this->type($needle) === $this->type($haystack)) {
      if (count($needle) !== count($haystack)) {
        throw new TypedCoupleException('incorrect number of keys', $needle, $haystack);
      } else {
        // Throws an exception if the values don't match.
        foreach ($needle as $key => $value) {
          if (!isset($haystack[$key])) {
            throw new TypedCoupleException("$key is undefined", $needle, $haystack);
          } else if (!$this->couple($value)($haystack[$key])) {
            throw new TypedCoupleException("$key is not valid", $needle, $haystack);
          }
        }

        // Returns true because all of the values must have matched.
        return true;
      }
    }

    // Otherwise returns false since the values can't possibly match.
    else {
      return false;
    }
  }
}
