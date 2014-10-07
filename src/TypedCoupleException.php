<?php namespace ht2\couple;

class TypedCoupleException extends \Exception {
  protected $needle;
  protected $haystack;

  public function __construct($message, $needle, $haystack) {
    // Sets properties for a validation exception.
    $this->needle = $needle;
    $this->haystack = $haystack;

    // Calls the parent's constructor.
    parent::__construct($message);
  }

  public function getNeedle() {
    return $this->needle;
  }

  public function getHaystack() {
    return $this->haystack;
  }
}
