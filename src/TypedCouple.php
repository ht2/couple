<?php namespace ht2\couple;

abstract class TypedCouple extends Couple {

  public $errors;

  public function __construct() {
    $this->errors = [];
  }

  public function addError($error) {
    array_push($this->errors, $error);
  }

  public function run($needle, $haystack, $modifier=null) {
    // Calls the method associated with the type.
    switch ($this->type($needle)) {
      // Adds cases for primitive types.
      case 'boolean': return $this->boolean($needle, $haystack);
      case 'integer': return $this->integer($needle, $haystack);
      case 'double': return $this->double($needle, $haystack);
      case 'string': return $this->string($needle, $haystack);
      case 'NULL': return $this->null($needle, $haystack);

      // Adds cases for other types.
      case 'array': return $this->arr($needle, $haystack);
      case 'object': return $this->obj($needle, $haystack);
      case 'function': return $this->func($needle, $haystack);

      // Adds default for unknown types.
      default: return $this->unknown($needle, $haystack);
    }
  }
  public function type($value) {

    // Returns 'function' if the value is func.
    // This is needed because gettype doesn't return 'unknown type'.
    if (is_callable($value) || (is_object($value) && ($value instanceof Closure))) {
      return 'function';
    }

    // Returns 'regexp' if value is a regular expression.
    else if (is_a($value, 'Regexp')) {
      return 'regexp';
    }

    // Otherwise returns the type of the value.
    else {
      return gettype($value);
    }
  }

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

  abstract public function arr($needle, $haystack);
  public function obj($needle, $haystack) {
    return $needle->run($needle, $haystack);
  }
  public function func($needle, $haystack) {
    return $needle($needle, $haystack);
  }

  public function unknown($needle, $haystack) {
    $this->addError(new TypedCoupleException('unknown type', $needle, $haystack));
    return $needle;
  }
}
