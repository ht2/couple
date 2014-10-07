<?php namespace mergeTest;

class MergeTest extends \PHPUnit_Framework_TestCase {

  protected $couple;

  /**
   * Sets up tests for the couple/Merge.
   */
  public function setup() {
    // Adds values needed by all tests.
    $this->couple = new \ht2\couple\Merge();

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests the primitive method.
   */
  public function testPrimitive() {
    $needle = 'hello world';
    $result = $this->couple->primitive($needle, 10);
    $this->assertEquals($needle, $result);
  }

  /**
   * Tests the arr method.
   */
  public function testArrPrimitive() {
    $needle = [];
    $result = $this->couple->arr($needle, 10);
    $this->assertEquals($needle, $result);
  }

  /**
   * Tests the arr method.
   */
  public function testArrArr() {
    $needle = [
      'a' => 1,
      'b' => 1
    ];
    $haystack = [
      'b' => 2,
      'c' => 2
    ];
    $result = $this->couple->arr($needle, $haystack);
    $this->assertEquals(1, $result['a']);
    $this->assertEquals(1, $result['b']);
    $this->assertEquals(2, $result['c']);
  }
}

// Creates an object class for tests.
class MyObject {
  public function run($needle, $haystack) {
    return $haystack === 20;
  }
}
