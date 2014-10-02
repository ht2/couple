<?php

include_once(__DIR__ . '/../src/TypedCouple.php');

class TypedCoupleTest extends PHPUnit_Framework_TestCase {

  protected $couple;
  protected $haystack;

  /**
   * Sets up tests for the couple/TypedCouple.
   */
  public function setup() {
    // Creates a new TypedCouple.
    $this->couple = new TypedCouple();
    $this->haystack = [];

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests that the modifier recieves a haystack.
   */
  public function testType() {
    $this->assertEquals($this->couple->type(false), 'boolean');
    $this->assertEquals($this->couple->type(10), 'integer');
    $this->assertEquals($this->couple->type(10.0), 'double');
    $this->assertEquals($this->couple->type('hello world'), 'string');
    $this->assertEquals($this->couple->type(NULL), 'NULL');
    $this->assertEquals($this->couple->type([]), 'array');
    $this->assertEquals($this->couple->type(function () {}), 'function');
    //$this->assertEquals($this->couple->type(new TypedCouple()), 'unknown type');
  }

  public function testBoolean() {
    $value = false;
    $result = $this->couple->boolean($value, $this->haystack);
    $this->assertEquals($result['type'], 'boolean');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  public function testInteger() {
    $value = 10;
    $result = $this->couple->integer($value, $this->haystack);
    $this->assertEquals($result['type'], 'integer');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  public function testDouble() {
    $value = 10.0;
    $result = $this->couple->double($value, $this->haystack);
    $this->assertEquals($result['type'], 'double');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  public function testString() {
    $value = 'Hello world';
    $result = $this->couple->string($value, $this->haystack);
    $this->assertEquals($result['type'], 'string');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  public function testNull() {
    $value = NULL;
    $result = $this->couple->null($value, $this->haystack);
    $this->assertEquals($result['type'], 'NULL');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  public function testReference() {
    $value = [];
    $result = $this->couple->reference($value, $this->haystack);
    $this->assertEquals($result['type'], 'array');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }

  public function testOperation() {
    $value = function () {};
    $result = $this->couple->operation($value, $this->haystack);
    $this->assertEquals($result['type'], 'function');
    $this->assertEquals($result['needle'], $value);
    $this->assertEquals($result['haystack'], $this->haystack);
  }
}

class TypedCouple extends couple\TypedCouple {
  public function primitive($needle, $haystack) {
    return [
      'type' => $this->type($needle),
      'needle' => $needle,
      'haystack' => $haystack
    ];
  }

  public function reference($needle, $haystack) {
    return [
      'type' => $this->type($needle),
      'needle' => $needle,
      'haystack' => $haystack
    ];
  }

  public function operation($needle, $haystack) {
    return [
      'type' => $this->type($needle),
      'needle' => $needle,
      'haystack' => $haystack
    ];
  }
}
