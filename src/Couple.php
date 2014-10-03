<?php namespace couple;

class Couple {
  public function run($needle, $haystack, $modifier) {
    return $modifier($needle, $haystack);
  }
}

