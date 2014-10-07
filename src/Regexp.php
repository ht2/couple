<?php namespace ht2\couple;

class Regexp extends Couple {

  protected $pattern;

  public function __construct($pattern) {
    $this->pattern = $pattern;
  }

  public function run($needle, $haystack, $modifier=null) {
    return preg_match($this->pattern, $haystack);
  }
}
