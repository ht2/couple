<?php namespace couple;

include_once(__DIR__ . '/Couple.php');

class Regexp extends Couple {

  protected $pattern;

  public function __construct($pattern) {
    $this->pattern = $pattern;
  }

  public function run($haystack) {
    return preg_match($this->pattern, $haystack);
  }
}
