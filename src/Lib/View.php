<?php

namespace PhalconZ\Lib;

use Phalcon\Mvc\View as PhalconView;

class View extends PhalconView {

  /**
   * Gets base path
   *
   * @return string
   */
  public function getBasePath()
  {
    return APP_PATH;
  }

  function __call($name, $args = null) {
    if(! $name || ! isSet($this->$name)) return;
    $list = class_implements($this->$name);
    $a = $this->$name;
    if(in_array("PhalconZ\\Lib\\InvokableInterface", $list)) return $a->__invoke();
    return $this;
  }
}