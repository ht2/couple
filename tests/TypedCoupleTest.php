<?php namespace typedCoupleTest;

include_once(__DIR__ . '/../src/TypedCouple.php');

class TypedCoupleTest extends \PHPUnit_Framework_TestCase {

  protected $haystack;
  protected $typedCouple;

  /**
   * Sets up tests for the couple/TypedCouple.
   */
  public function setup() {
    // Adds values needed by all tests.
    $this->haystack = [];
    $this->couple = new MyTypedCouple();

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests the type method.
   */
  public function testType() {
    $this->assertEquals($this->couple->type(false), 'boolean');
    $this->assertEquals($this->couple->type(10), 'integer');
    $this->assertEquals($this->couple->type(10.0), 'double');
    $this->assertEquals($this->couple->type('hello world'), 'string');
    $this->assertEquals($this->couple->type(NULL), 'NULL');
    $this->assertEquals($this->couple->type([]), 'array');
    $this->assertEquals($this->couple->type(function () {}), 'function');
  }

  /**
   * Tests the boolean method.
   */
  public function testBoolean() {
    $value = false;
    $result = $this->couple->boolean($value, $this->haystack);
    $this->assertEquals($result['type'], 'boolean');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  /**
   * Tests the integer method.
   */
  public function testInteger() {
    $value = 10;
    $result = $this->couple->integer($value, $this->haystack);
    $this->assertEquals($result['type'], 'integer');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  /**
   * Tests the double method.
   */
  public function testDouble() {
    $value = 10.0;
    $result = $this->couple->double($value, $this->haystack);
    $this->assertEquals($result['type'], 'double');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  /**
   * Tests the string method.
   */
  public function testString() {
    $value = 'Hello world';
    $result = $this->couple->string($value, $this->haystack);
    $this->assertEquals($result['type'], 'string');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  /**
   * Tests the null method.
   */
  public function testNull() {
    $value = null;
    $result = $this->couple->null($value, $this->haystack);
    $this->assertEquals($result['type'], 'NULL');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  /**
   * Tests the null method.
   */
  public function testPrimitive() {
    $value = 'hello world';
    $result = $this->couple->primitive($value, $this->haystack);
    $this->assertEquals($result['type'], 'string');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  /**
   * Tests the arr method.
   */
  public function testArr() {
    $value = [];
    $result = $this->couple->arr($value, $this->haystack);
    $this->assertEquals($result['type'], 'array');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  /**
   * Tests the obj method.
   */
  public function testObj() {
    $value = new MyObject();
    $result = $this->couple->obj($value, $this->haystack);
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  /**
   * Tests the func method.
   */
  public function testFunc() {
    $value = function ($needle, $haystack) {
      return [
        'needle' => $needle,
        'haystack' => $haystack
      ];
    };

    $result = $this->couple->func($value, $this->haystack);
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  /**
   * Tests the func method.
   */
  public function testUnknown() {
    $value = 10;
    try {
      $result = $this->couple->unknown($value, $this->haystack);
    } catch (\couple\TypedCoupleException $e) {
      $this->assertEquals($e->getMessage(), 'unknown type');
      $this->assertEquals($e->getNeedle(), $value);
      $this->assertEquals($e->getHaystack(), $this->haystack);
    } catch (\Exception $e) {
      $this->assertEquals(false, true);
    }
  }
}

// Creates an object class for tests.
class MyObject {
  public function run($haystack) {
    return [
      'needle' => $this,
      'haystack' => $haystack
    ];
  }
}

// Extends TypedCouple and implements the abstract methods for use in tests.
class MyTypedCouple extends \couple\TypedCouple {
  public function primitive($needle, $haystack) {
    return [
      'type' => $this->type($needle),
      'needle' => $needle,
      'haystack' => $haystack
    ];
  }

  public function arr($needle, $haystack) {
    return [
      'type' => $this->type($needle),
      'needle' => $needle,
      'haystack' => $haystack
    ];
  }

  public function func($needle, $haystack) {
    return [
      'type' => $this->type($needle),
      'needle' => $needle,
      'haystack' => $haystack
    ];
  }
}
