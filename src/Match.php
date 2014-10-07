<?php namespace ht2\couple;

class Match extends TypedCouple {
  public function primitive($needle, $haystack) {
    return $needle === $haystack;
  }

  public function arr($needle, $haystack) {
    // Matches if the type of the haystack is an array.
    if ('array' === $this->type($haystack)) {
      $match = true;

      // Returns false if the values don't match.
      foreach ($needle as $key => $value) {
        if (!array_key_exists($key, $haystack)){
          $this->addError(new TypedCoupleException("`$key` is not defined", $needle, $haystack));
          $match = false;
        } else if (!$this->run($value, $haystack[$key])) {
          $this->addError(new TypedCoupleException("`$key` does not match", $value, $haystack[$key]));
          $match = false;
        }
      }

      // Returns true because all of the values must have matched.
      return $match;
    }

    // Otherwise returns false since the values can't possibly match.
    else {
      return false;
    }
  }

  public function unknown($needle, $haystack) {
    return false;
  }
}
