<?php

class FieldTest extends PHPUnit_Framework_TestCase {

  protected $field;

  /**
   * Sets up tests for the couple/couple.
   */
  public function setup() {
    // Adds values needed by all tests.
    $this->field = new ht2\couple\Field();

    // Calls parent setup.
    parent::setUp();
  }

  /**
   * Tests `setOptional` method.
   */
  public function testOptional() {
    // Tests default behaviour.
    $this->assertEquals(false, $this->field->run($this->field, null));

    // Tests optional behaviour.
    $this->field->setOptional(true);
    $this->assertEquals(true, $this->field->run($this->field, null));

    // Tests required behaviour.
    $this->field->setOptional(false);
    $this->assertEquals(false, $this->field->run($this->field, null));
  }

  /**
   * Tests `addStates` method.
   */
  public function testStates() {
    $this->field->addStates([0, 1]);

    // Tests correct states.
    $this->assertEquals(true, $this->field->run($this->field, 0));
    $this->assertEquals(true, $this->field->run($this->field, 1));

    // Tests incorrect state(s).
    $this->assertEquals(false, $this->field->run($this->field, null));
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
    $this->assertEquals(true, $this->field->run($this->field, $data));

    // Tests incorrect state(s).
    $this->assertEquals(false, $this->field->run($this->field, null));
  }

  /**
   * Tests `setDefault` method.
   */
  public function testDefault() {
    $data = 0;
    $this->field->setDefault($data)->setExtend($data);
    $this->assertEquals(true, $this->field->run($this->field, null));
  }

}
