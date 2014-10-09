<?php namespace ht2\couple;

class TypedCoupleException extends \Exception {

  // Properties of the Exception.
  protected $needle, $haystack;

  /**
   * Constructs a new TypedCoupleException.
   * @param string $message description of the exception.
   * @param mixed $needle the needle that was in use when the exception was created.
   * @param mixed $haystack the haystack that was in use when the exception was created.
   */
  public function __construct($message, $needle, $haystack) {
    // Sets properties for a validation exception.
    $this->needle = $needle;
    $this->haystack = $haystack;

    // Calls the parent's constructor.
    parent::__construct($message);
  }

  /**
   * Gets the needle that was in use when the exception was created.
   * @return mixed needle.
   */
  public function getNeedle() {
    return $this->needle;
  }

  /**
   * Gets the haystack that was in use when the exception was created.
   * @return mixed haystack.
   */
  public function getHaystack() {
    return $this->haystack;
  }
}
