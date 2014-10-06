<?php namespace matchTest;

include_once(__DIR__ . '/../src/Match.php');

class MatchTest extends \PHPUnit_Framework_TestCase {

  protected $arrHaystack;
  protected $arrNeedle;
  protected $couple;

  /**
   * Sets up tests for the couple/Match.
   */
  public function setup() {
    // Adds values needed by all tests.
    $this->arrHaystack = [
      'hello world',
      [0],
      10,
      20
    ];
    $this->arrNeedle = [
      'hello world',
      [0],
      function ($haystack) { return $haystack === 10; },
      new MyObject()
    ];
    $this->couple = new \couple\Match();

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests the primitive method.
   */
  public function testPrimitive() {
    $needle = 'hello world';
    $result1 = $this->couple->primitive($needle, $needle);
    $this->assertEquals($result1, true);
    $result2 = $this->couple->primitive($needle, $needle . '.');
    $this->assertEquals($result2, false);
  }

  /**
   * Tests the arr method.
   */
  public function testMatchingArr() {
    $result = $this->couple->arr($this->arrHaystack, $this->arrNeedle);
    $this->assertEquals($result, true);
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr0() {
    $this->arrHaystack[0] = 'hello uk';
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals($result, false);
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr1() {
    $this->arrHaystack[1] = ['hello' => 0];
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals($result, false);
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr2() {
    $this->arrHaystack[2] = 11;
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals($result, false);
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr3() {
    $this->arrHaystack[3] = 21;
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals($result, false);
  }
}

// Creates an object class for tests.
class MyObject {
  public function run($haystack) {
    return $haystack === 20;
  }
}
