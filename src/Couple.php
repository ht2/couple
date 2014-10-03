<?php namespace couple;

class Couple {
  public function run($modifier, $needle, $haystack) {
    return $modifier($needle, $haystack);
  }
}

