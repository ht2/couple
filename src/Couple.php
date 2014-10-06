<?php namespace couple;

class Couple {
  public function run($haystack, $needle, $modifier) {
    return $modifier($needle, $haystack);
  }
}

