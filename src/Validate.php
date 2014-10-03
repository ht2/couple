<?php namespace couple;

include_once(__DIR__ . '/Match.php');

class Validate extends Match {
  public function arr($needle, $haystack) {
    // Matches if the type of the haystack is an array.
    if ('array' === $this->type($haystack)) {
      if (count($needle) !== count($haystack)) {
        throw new TypedCoupleException('incorrect number of keys', $needle, $haystack);
      } else {
        // Throws an exception if the values don't match.
        foreach ($needle as $key => $value) {
          if (!isset($haystack[$key])) {
            throw new TypedCoupleException("`$key` is not defined", $needle, $haystack);
          } else if (!$this->run($value, $haystack[$key])) {
            throw new TypedCoupleException("`$key` is not valid", $value, $haystack[$key]);
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
