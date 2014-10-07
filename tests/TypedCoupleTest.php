<?php

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
    $this->assertEquals('boolean', $this->couple->type(false));
    $this->assertEquals('integer', $this->couple->type(10));
    $this->assertEquals('double', $this->couple->type(10.0));
    $this->assertEquals('string', $this->couple->type('hello world'));
    $this->assertEquals('NULL', $this->couple->type(NULL));
    $this->assertEquals('array', $this->couple->type([]));
    $this->assertEquals('function', $this->couple->type(function () {}));
  }

  /**
   * Tests the boolean method.
   */
  public function testBoolean() {
    $needle = false;
    $result = $this->couple->boolean($needle, $this->haystack);
    $this->assertEquals('boolean', $result['type']);
    $this->assertEquals($needle, $result['needle']);
    $this->assertEquals($this->haystack, $result['haystack']);
  }

  /**
   * Tests the integer method.
   */
  public function testInteger() {
    $needle = 10;
    $result = $this->couple->integer($needle, $this->haystack);
    $this->assertEquals('integer', $result['type']);
    $this->assertEquals($needle, $result['needle']);
    $this->assertEquals($this->haystack, $result['haystack']);
  }

  /**
   * Tests the double method.
   */
  public function testDouble() {
    $needle = 10.0;
    $result = $this->couple->double($needle, $this->haystack);
    $this->assertEquals('double', $result['type']);
    $this->assertEquals($needle, $result['needle']);
    $this->assertEquals($this->haystack, $result['haystack']);
  }

  /**
   * Tests the string method.
   */
  public function testString() {
    $needle = 'Hello world';
    $result = $this->couple->string($needle, $this->haystack);
    $this->assertEquals('string', $result['type']);
    $this->assertEquals($needle, $result['needle']);
    $this->assertEquals($this->haystack, $result['haystack']);
  }

  /**
   * Tests the null method.
   */
  public function testNull() {
    $needle = null;
    $result = $this->couple->null($needle, $this->haystack);
    $this->assertEquals('NULL', $result['type']);
    $this->assertEquals($needle, $result['needle']);
    $this->assertEquals($this->haystack, $result['haystack']);
  }

  /**
   * Tests the null method.
   */
  public function testPrimitive() {
    $needle = 'hello world';
    $result = $this->couple->primitive($needle, $this->haystack);
    $this->assertEquals('string', $result['type']);
    $this->assertEquals($needle, $result['needle']);
    $this->assertEquals($this->haystack, $result['haystack']);
  }

  /**
   * Tests the arr method.
   */
  public function testArr() {
    $needle = [];
    $result = $this->couple->arr($needle, $this->haystack);
    $this->assertEquals('array', $result['type']);
    $this->assertEquals($needle, $result['needle']);
    $this->assertEquals($this->haystack, $result['haystack']);
  }

  /**
   * Tests the obj method.
   */
  public function testObj() {
    $needle = new MyObject();
    $result = $this->couple->obj($needle, $this->haystack);
    $this->assertEquals($needle, $result['needle']);
    $this->assertEquals($this->haystack, $result['haystack']);
  }

  /**
   * Tests the func method.
   */
  public function testFunc() {
    $needle = function ($needle, $haystack) {
      return [
        'needle' => $needle,
        'haystack' => $haystack
      ];
    };

    $result = $this->couple->func($needle, $this->haystack);
    $this->assertEquals($needle, $result['needle']);
    $this->assertEquals($this->haystack, $result['haystack']);
  }

  /**
   * Tests the func method.
   */
  public function testUnknown() {
    $needle = 10;
    try {
      $result = $this->couple->unknown($needle, $this->haystack);
    } catch (\couple\TypedCoupleException $e) {
      $this->assertEquals('unknown type', $e->getMessage());
      $this->assertEquals($needle, $e->getNeedle());
      $this->assertEquals($this->haystack, $e->getHaystack());
    } catch (\Exception $e) {
      $this->assertEquals(true, false);
    }
  }
}

// Creates an object class for tests.
class MyObject {
  public function run($needle, $haystack) {
    return [
      'needle' => $needle,
      'haystack' => $haystack
    ];
  }
}

// Extends TypedCouple and implements the abstract methods for use in tests.
class MyTypedCouple extends ht2\couple\TypedCouple {
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
