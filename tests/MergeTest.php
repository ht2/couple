<?php namespace mergeTest;

include_once(__DIR__ . '/../src/Merge.php');

class MergeTest extends \PHPUnit_Framework_TestCase {

  protected $couple;

  /**
   * Sets up tests for the couple/Merge.
   */
  public function setup() {
    // Adds values needed by all tests.
    $this->couple = new \couple\Merge();

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests the primitive method.
   */
  public function testPrimitive() {
    $needle = 'hello world';
    $result = $this->couple->primitive($needle, 10);
    $this->assertEquals($result, $needle);
  }

  /**
   * Tests the arr method.
   */
  public function testArrPrimitive() {
    $needle = [];
    $result = $this->couple->arr($needle, 10);
    $this->assertEquals($result, $needle);
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
    $result = $this->couple->arr($haystack, $needle);
    $this->assertEquals($result['a'], 1);
    $this->assertEquals($result['b'], 1);
    $this->assertEquals($result['c'], 2);
  }
}

// Creates an object class for tests.
class MyObject {
  public function run($haystack) {
    return $haystack === 20;
  }
}
