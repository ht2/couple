<?php

include_once(__DIR__ . '/../src/TypedCoupleException.php');

class TypedCoupleExceptionTest extends PHPUnit_Framework_TestCase {

  protected $exception, $needle, $haystack, $message;

  /**
   * Sets up tests for the couple/couple.
   */
  public function setup() {
    // Creates a needle and a haystack.
    $this->message = 'message';
    $this->needle = new stdClass();
    $this->haystack = new stdClass();
    $this->exception = new couple\TypedCoupleException(
      $this->message,
      $this->needle,
      $this->haystack
    );

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests the `getMessage` method.
   */
  public function testMessage() {
    // Tests the result is correct.
    $this->assertEquals($this->exception->getMessage(), $this->message);
  }

  /**
   * Tests the `getNeedle` method.
   */
  public function testNeedle() {
    // Tests the result is correct.
    $this->assertEquals($this->exception->getNeedle(), $this->needle);
  }

  /**
   * Tests the `getHaystack` method.
   */
  public function testHaystack() {
    // Tests the result is correct.
    $this->assertEquals($this->exception->getHaystack(), $this->haystack);
  }
}
