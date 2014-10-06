<?php

include_once(__DIR__ . '/../src/Regexp.php');

class RegexpTest extends PHPUnit_Framework_TestCase {

  protected $couple;
  protected $haystack;

  /**
   * Sets up tests for the couple/couple.
   */
  public function setup() {
    // Creates a needle and a haystack.
    $this->haystack = 'hello world';
    $this->couple = new couple\Regexp('#hello world#');

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests the `run` method.
   */
  public function testRun() {
    // Gets the result from couple.
    $coupleResult = $this->couple->run($this->haystack);

    // Tests the result is correct.
    $this->assertEquals($coupleResult, true);
  }
}
