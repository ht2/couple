<?php namespace validateTest;

class ValidateTest extends \PHPUnit_Framework_TestCase {

  protected $arrHaystack;
  protected $arrNeedle;
  protected $couple;

  /**
   * Sets up tests for the couple/Validate.
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
      function ($needle, $haystack) { return $haystack === 10; },
      new Object()
    ];
    $this->couple = new \ht2\couple\Validate();

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests the null method.
   */
  public function testPrimitive() {
    $needle = 'hello world';
    $result = $this->couple->primitive($needle, $needle);
    $this->assertEquals(true, $result);
    $result = $this->couple->primitive($needle, $needle . '.');
    $this->assertEquals(false, $result);
  }

  /**
   * Tests the arr method.
   */
  public function testMatchingArr() {
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals(true, $result);
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr0() {
    $key = 0;
    $this->arrHaystack[0] = 'hello uk';
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals(false, $result);
    $exception = $this->couple->errors[0];
    $this->assertEquals("`$key` is not valid", $exception->getMessage());
    $this->assertEquals($this->arrNeedle[$key], $exception->getNeedle());
    $this->assertEquals($this->arrHaystack[$key], $exception->getHaystack());
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr1() {
    $key = 1;
    $this->arrHaystack[$key] = ['hello' => 0];
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals(false, $result);
    $exception = $this->couple->errors[0];
    $this->assertEquals("`0` is not defined", $exception->getMessage());
    $this->assertEquals($this->arrNeedle[$key], $exception->getNeedle());
    $this->assertEquals($this->arrHaystack[$key], $exception->getHaystack());
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr2() {
    $key = 2;
    $this->arrHaystack[2] = 11;
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals(false, $result);
    $exception = $this->couple->errors[0];
    $this->assertEquals("`$key` is not valid", $exception->getMessage());
    $this->assertEquals($this->arrNeedle[$key], $exception->getNeedle());
    $this->assertEquals($this->arrHaystack[$key], $exception->getHaystack());
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr3() {
    $key = 3;
    $this->arrHaystack[$key] = 21;
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals(false, $result);
    $exception = $this->couple->errors[0];
    $this->assertEquals("`$key` is not valid", $exception->getMessage());
    $this->assertEquals($this->arrNeedle[$key], $exception->getNeedle());
    $this->assertEquals($this->arrHaystack[$key], $exception->getHaystack());
  }
}

// Creates an object class for tests.
class Object {
  public function run($needle, $haystack) {
    return $haystack === 20;
  }
}
