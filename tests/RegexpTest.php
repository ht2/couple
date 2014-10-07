<?php

class RegexpTest extends PHPUnit_Framework_TestCase {

  protected $couple;
  protected $haystack;

  /**
   * Sets up tests for the couple/couple.
   */
  public function setup() {
    // Creates a needle and a haystack.
    $this->haystack = 'hello world';
    $this->couple = new ht2\couple\Regexp('#hello world#');

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests the `run` method.
   */
  public function testRun() {
    // Gets the result from couple.
    $coupleResult = $this->couple->run($this->couple, $this->haystack);

    // Tests the result is correct.
    $this->assertEquals(true, $coupleResult);
  }
}
