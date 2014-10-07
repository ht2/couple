<?php namespace ht2\couple;

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

  public function run($needle, $haystack, $modifier=null) {
    // Merges the `haystack` with the `def`.
    $mergedValue = $this->merge->run($haystack, $this->def);

    // Returns `true` if the haystack is not defined and it's optional.
    if (is_null($mergedValue)) {
      return $this->optional;
    }

    // Tries to match the haystack with a state.
    else if (count($this->states) > 0) {
      foreach ($this->states as $state) {
        // Merges the state with `extend`.
        $state = $this->merge->run($state, $this->extend);

        try {
          // Validates that the `mergedValue` matches the `state`.
          if ($this->validate->run($state, $mergedValue)) {
            return true;
          }
        } catch (TypedCoupleException $e) {
        }
      }

      return false;
    }

    // Tries to match the haystack with `extend` if no states are defined.
    else {
      return $this->validate->run($this->extend, $mergedValue);
    }
  }

  public function setExtend($extend) {
    // Merges the previous `extend` with the new one.
    $this->extend = $this->merge->run($extend, $this->extend);
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
    $this->def = $this->merge->run($def, $this->def);
    return $this;
  }
}

