<?php namespace ht2\couple;

class Validate extends Match {
  public function arr($needle, $haystack) {
    // Matches key values if the type of the haystack is an array.
    if ('array' === $this->type($haystack)) {
      if (count($needle) !== count($haystack)) {
        $this->addError(new TypedCoupleException('incorrect number of keys', $needle, $haystack));
        return false;
      } else {
        return $this->matchKeyValues($needle, $haystack);
      }
    }

    // Otherwise returns false since the values can't possibly match.
    else {
      return false;
    }
  }
}
