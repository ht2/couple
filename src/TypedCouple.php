<?php namespace couple;

abstract class TypedCouple {
  public $couple;

  public function __construct() {
    $this->couple = couple(function ($needle, $haystack) {
      // Calls the method associated with the type.
      switch ($this->type($needle)) {
        // Adds cases for primitive types.
        case 'boolean': return $this->boolean($needle, $haystack);
        case 'integer': return $this->integer($needle, $haystack);
        case 'double': return $this->double($needle, $haystack);
        case 'string': return $this->string($needle, $haystack);
        case 'NULL': return $this->null($needle, $haystack);

        // Adds cases for reference types.
        case 'array': return $this->reference($needle, $haystack);

        // Adds cases for operational types.
        case 'function': return $this->operation($needle, $haystack);

        // Adds default for unknown types.
        default: return $this->unknown($needle, $haystack);
      }
    });
  }

  public function type($value) {
    // Returns function if the value is callable.
    // This is needed because gettype doesn't return 'unknown type'.
    if (is_callable($value)) {
      return 'function';
    }

    // Otherwise returns the type of the value.
    else {
      return gettype($value);
    }
  }

  // Adds methods for primitive types.
  abstract public function primitive($needle, $haystack);
  public function boolean($needle, $haystack) {
    return $this->primitive($needle, $haystack);
  }
  public function integer($needle, $haystack) {
    return $this->primitive($needle, $haystack);
  }
  public function double($needle, $haystack) {
    return $this->primitive($needle, $haystack);
  }
  public function string($needle, $haystack) {
    return $this->primitive($needle, $haystack);
  }
  public function null($needle, $haystack) {
    return $this->primitive($needle, $haystack);
  }

  // Adds abstract methods for reference types.
  abstract public function reference($needle, $haystack);

  // Adds abstract methods for operational types.
  public function operation($needle, $haystack) {
    return $needle($haystack);
  }

  // Adds other methods.
  public function unknown($needle, $haystack) {
    throw new TypedCoupleException('Unknown type', $needle, $haystack);
  }
}

class TypedCoupleException extends \Exception {
  protected $needle;
  protected $haystack;

  public function __construct($message, $needle, $haystack) {
    // Sets properties for a validation exception.
    $this->needle = $needle;
    $this->haystack = $haystack;

    // Calls the parent's constructor.
    parent::__construct($message);
  }

  public function getNeedle() {
    return $this->needle;
  }

  public function getHaystack() {
    return $this->haystack;
  }
}
