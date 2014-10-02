<?php namespace couple;

function couple(mod) {
  return function (needle) use (mod) {
    return function (haystack) use (mod, needle) {
      return mod(needle, haystack);
    };
  };
}
