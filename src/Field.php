<?php namespace ht2\couple;

class Field extends Couple {

  // Properties of the field.
  protected $optional, $states, $extend, $def;

  // Couples required by the field.
  protected $merge, $validate;

  /**
   * Constructs a new field.
   */
  public function __construct() {
    $this->optional = false;
    $this->states = [];
    $this->extend = [];
    $this->def = null;
    $this->merge = new Merge();
    $this->validate = new Validate();
  }

  /**
   * Validates the haystack using the field.
   * @param mixed $needle should be equal to $this.
   * @param mixed $haystack the data to validate with the field.
   * @return boolean true if the haystack is valid.
   */
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

  /**
   * Merges the extend property of the field.
   * @param mixed $extend extension to merge.
   * @return Field $this.
   */
  public function setExtend($extend) {
    // Merges the previous `extend` with the new one.
    $this->extend = $this->merge->run($extend, $this->extend);
    return $this;
  }

  /**
   * Adds a state.
   * @param array $states the new states to be added.
   * @return Field $this.
   */
  public function addStates($states) {
    // Merges the previous `states` with the new ones.
    $this->states = array_merge($this->states, $states);
    return $this;
  }

  /**
   * Sets the optional property of the field which determines if the field is optional.
   * @param boolean $optional true if the field is optional.
   * @return Field $this.
   */
  public function setOptional($optional) {
    $this->optional = $optional;
    return $this;
  }

  /**
   * Sets the default for the field.
   * @param mixed $def default value of the field.
   * @return Field $this.
   */
  public function setDefault($def) {
    // Merges the previous `def` with the new one.
    $this->def = $this->merge->run($def, $this->def);
    return $this;
  }
}

