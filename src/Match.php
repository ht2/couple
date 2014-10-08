<?php namespace ht2\couple;

class Match extends TypedCouple {
  public function primitive($needle, $haystack) {
    return $needle === $haystack;
  }

  protected function matchKeyValues($needle, $haystack) {
    $match = true;
    foreach ($needle as $key => $value) {
      if (!array_key_exists($key, $haystack)) {
        $this->addError(new TypedCoupleException("`$key` is not defined", $needle, $haystack));
        $match = false;
      } else if (!$this->run($value, $haystack[$key])) {
        $this->addError(new TypedCoupleException("`$key` does not match", $value, $haystack[$key]));
        $match = false;
      }
    }
    return $match;
  }

  public function arr($needle, $haystack) {
    // Matches key values if the type of the haystack is an array.
    if ('array' === $this->type($haystack)) {
      return $this->matchKeyValues($needle, $haystack);
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
