<?php namespace couple;

include_once(__DIR__ . '/TypedCouple.php');

class Match extends TypedCouple {
  public function primitive($needle, $haystack) {
    return $needle === $haystack;
  }

  public function arr($needle, $haystack) {
    // Matches if the type of the haystack is an array.
    if ('array' === $this->type($haystack)) {
      // Returns false if the values don't match.
      foreach ($needle as $key => $value) {
        if (!isset($haystack[$key]) || !$this->run($value, $haystack[$key])) {
          return false;
        }
      }

      // Returns true because all of the values must have matched.
      return true;
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
