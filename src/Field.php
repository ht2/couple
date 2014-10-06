<?php namespace couple;

include_once(__DIR__ . '/Merge.php');
include_once(__DIR__ . '/Validate.php');

class Field extends Couple {

  protected $optional, $states, $extend, $def, $merge, $validate;

  public function __construct() {
    $this->optional = false;
    $this->states = [];
    $this->extend = [];
    $this->def = null;
    $this->merge = new Merge();
    $this->validate = new Validate();
  }

  public function run($haystack, $needle=null, $modifier=null) {
    // Merges the `haystack` with the `def`.
    $mergedValue = $this->merge->run($this->def, $haystack);

    // Returns `true` if the haystack is not defined and it's optional.
    if (is_null($mergedValue)) {
      return $this->optional;
    }

    // Tries to match the haystack with a state.
    else if (count($this->states) > 0) {
      foreach ($this->states as $state) {
        // Merges the state with `extend`.
        $state = $this->merge->run($this->extend, $state);

        try {
          // Validates that the `mergedValue` matches the `state`.
          if ($this->validate->run($mergedValue, $state)) {
            return true;
          }
        } catch (TypedCoupleException $e) {
        }
      }

      return false;
    }

    // Tries to match the haystack with `extend` if no states are defined.
    else {
      return $this->validate->run($mergedValue, $this->extend);
    }
  }

  public function setExtend($extend) {
    // Merges the previous `extend` with the new one.
    $this->extend = $this->merge->run($this->extend, $extend);
    return $this;
  }

  public function addStates($states) {
    // Merges the previous `states` with the new ones.
    $this->states = array_merge($this->states, $states);
    return $this;
  }

  public function setOptional($optional) {
    $this->optional = $optional;
    return $this;
  }

  public function setDefault($def) {
    // Merges the previous `def` with the new one.
    $this->def = $this->merge->run($this->def, $def);
    return $this;
  }
}

