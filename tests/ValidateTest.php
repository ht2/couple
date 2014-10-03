<?php namespace validateTest;

include_once(__DIR__ . '/../src/Validate.php');

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
      function ($haystack) { return $haystack === 10; },
      new Object()
    ];
    $this->couple = new \couple\Validate();

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests the null method.
   */
  public function testPrimitive() {
    $needle = 'hello world';
    $result = $this->couple->primitive($needle, $needle);
    $this->assertEquals($result, true);
    $result = $this->couple->primitive($needle, $needle . '.');
    $this->assertEquals($result, false);
  }

  /**
   * Tests the arr method.
   */
  public function testMatchingArr() {
    $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
    $this->assertEquals($result, true);
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr0() {
    try {
      $key = 0;
      $this->arrHaystack[0] = 'hello uk';
      $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
      $this->assertEquals($result, false);
    } catch (\couple\TypedCoupleException $e) {
      $this->assertEquals($e->getMessage(), "`$key` is not valid");
      $this->assertEquals($e->getNeedle(), $this->arrNeedle[$key]);
      $this->assertEquals($e->getHaystack(), $this->arrHaystack[$key]);
    } catch (Exception $e) {
      $this->assertEquals(false, true);
    }
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr1() {
    try {
      $key = 1;
      $this->arrHaystack[$key] = ['hello' => 0];
      $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
      $this->assertEquals($result, false);
    } catch (\couple\TypedCoupleException $e) {
      $this->assertEquals($e->getMessage(), "`0` is not defined");
      $this->assertEquals($e->getNeedle(), $this->arrNeedle[$key]);
      $this->assertEquals($e->getHaystack(), $this->arrHaystack[$key]);
    } catch (\Exception $e) {
      $this->assertEquals(false, true);
    }
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr2() {
    try {
      $key = 2;
      $this->arrHaystack[2] = 11;
      $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
      $this->assertEquals($result, false);
    } catch (\couple\TypedCoupleException $e) {
      $this->assertEquals($e->getMessage(), "`$key` is not valid");
      $this->assertEquals($e->getNeedle(), $this->arrNeedle[$key]);
      $this->assertEquals($e->getHaystack(), $this->arrHaystack[$key]);
    } catch (Exception $e) {
      $this->assertEquals(false, true);
    }
  }

  /**
   * Tests the arr method.
   */
  public function testNonMatchingArr3() {
    try {
      $key = 3;
      $this->arrHaystack[$key] = 21;
      $result = $this->couple->arr($this->arrNeedle, $this->arrHaystack);
      $this->assertEquals($result, false);
    } catch (\couple\TypedCoupleException $e) {
      $this->assertEquals($e->getMessage(), "`$key` is not valid");
      $this->assertEquals($e->getNeedle(), $this->arrNeedle[$key]);
      $this->assertEquals($e->getHaystack(), $this->arrHaystack[$key]);
    } catch (Exception $e) {
      $this->assertEquals(false, true);
    }
  }
}

// Creates an object class for tests.
class Object {
  public function run($haystack) {
    return $haystack === 20;
  }
}
