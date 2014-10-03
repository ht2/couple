<?php

include_once(__DIR__ . '/../src/Couple.php');

class CoupleTest extends PHPUnit_Framework_TestCase {

  protected $needle;
  protected $haystack;

  /**
   * Sets up tests for the couple/couple.
   */
  public function setup() {
    // Creates a needle and a haystack.
    $this->needle = [];
    $this->haystack = [];
    $this->couple = new couple\Couple();

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests that the modifier recieves a haystack.
   */
  public function testNeedle() {
    // Gets the result from couple.
    $coupleResult = $this->couple->run(function ($needle, $haystack) {
      return $needle;
    }, $this->needle, $this->haystack);

    // Tests the result is correct.
    $this->assertEquals($coupleResult, $this->needle);
  }

  /**
   * Tests that the modifier recieves a haystack.
   */
  public function testHaystack() {
    // Gets the result from couple.
    $coupleResult = $this->couple->run(function ($needle, $haystack) {
      return $haystack;
    }, $this->needle, $this->haystack);

    // Tests the result is correct.
    $this->assertEquals($coupleResult, $this->haystack);
  }
}
