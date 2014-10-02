<?php namespace couple;

class Merge extends TypedCouple {
  public function primitive($needle, $haystack) {
    return $needle;
  }

  public function array($needle, $haystack) {
    // Merges if the type of the haystack is an array.
    if ('array' === $this->type($haystack)) {
      // Copies the haystack to avoid overwriting.
      $array = $haystack;

      // Merge the array with the needle.
      // We can't use array_merge because its behaviour differs from couple.js.
      foreach ($needle as $key => $value) {
        if (isset($haystack[$key])) {
          $array[$key] = $this->couple($value)($haystack[$key]);
        } else {
          $array[$key] = $value;
        }
      }

      // Returns the merged array.
      return $array;
    }

    // Otherwise returns the needle.
    else {
      return $needle;
    }
  }

  public function unknown($needle, $haystack) {
    return $needle;
  }
}
