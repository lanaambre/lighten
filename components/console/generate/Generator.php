<?php

namespace components\console\generate;

class Generator
{
  protected $arguments;

  public function __construct($args)
  {
    $this->arguments = $args;
    $this->init();
  }
}
