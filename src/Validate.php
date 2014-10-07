<?php namespace ht2\couple;

class Validate extends Match {
  public function arr($needle, $haystack) {
    // Matches if the type of the haystack is an array.
    if ('array' === $this->type($haystack)) {
      $valid = true;

      if (count($needle) !== count($haystack)) {
        $this->addError(new TypedCoupleException('incorrect number of keys', $needle, $haystack));
        $valid = false;
      } else {
        // Throws an exception if the values don't match.
        foreach ($needle as $key => $value) {
          if (!isset($haystack[$key]) && !is_null($haystack[$key])) {
            $this->addError(new TypedCoupleException("`$key` is not defined", $needle, $haystack));
            $valid = false;
          } else if (!$this->run($value, $haystack[$key])) {
            $this->addError(new TypedCoupleException("`$key` is not valid", $value, $haystack[$key]));
            $valid = false;
          }
        }

        // Returns true because all of the values must have matched.
        return $valid;
      }
    }

    // Otherwise returns false since the values can't possibly match.
    else {
      return false;
    }
  }
}
