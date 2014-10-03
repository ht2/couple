<?php namespace couple;

class Regexp {

  protected $pattern;

  public function __construct($pattern) {
    $this->pattern = $pattern;
  }

  public function test() {
    return preg_match($this->pattern);
  }
}
