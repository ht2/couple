<?php namespace ht2\couple;

class Couple {
  /**
   * Calls the modifier with a needle and haystack.
   * @param mixed $needle the needle to pass to the modifier.
   * @param mixed $haystack the haystack to pass to the modifier.
   * @param callable $modifier a function to be called with the needle and haystack.
   * @return mixed returns the result of calling the modifier with the needle and haystack.
   */
  public function run($needle, $haystack, $modifier) {
    return $modifier($needle, $haystack);
  }
}

