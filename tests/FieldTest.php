<?php

include_once(__DIR__ . '/../src/Field.php');

class FieldTest extends PHPUnit_Framework_TestCase {

  protected $field;

  /**
   * Sets up tests for the couple/couple.
   */
  public function setup() {
    // Adds values needed by all tests.
    $this->field = new couple\Field();

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests `setOptional` method.
   */
  public function testOptional() {
    // Tests default behaviour.
    $this->assertEquals($this->field->run(null), false);

    // Tests optional behaviour.
    $this->field->setOptional(true);
    $this->assertEquals(true, $this->field->run(null));

    // Tests required behaviour.
    $this->field->setOptional(false);
    $this->assertEquals($this->field->run(null), false);
  }

  /**
   * Tests `addStates` method.
   */
  public function testStates() {
    $this->field->addStates([0, 1]);

    // Tests correct states.
    $this->assertEquals($this->field->run(0), true);
    $this->assertEquals($this->field->run(1), true);

    // Tests incorrect state(s).
    $this->assertEquals($this->field->run(null), false);
  }

  /**
   * Tests `setExtend` method.
   */
  public function testExtend() {
    $data = [
      'a' => 0
    ];

    $this->field->setExtend($data);

    // Tests correct states.
    $this->assertEquals($this->field->run($data), true);

    // Tests incorrect state(s).
    $this->assertEquals($this->field->run(null), false);
  }

  /**
   * Tests `setDefault` method.
   */
  public function testDefault() {
    $data = 0;
    $this->field->setDefault($data)->setExtend($data);
    $this->assertEquals($this->field->run(null), true);
  }

}
