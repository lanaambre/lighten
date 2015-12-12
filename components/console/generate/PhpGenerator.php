<?php

namespace components\console\generate;

class PhpGenerator
{
  protected $arguments;
  protected $code = '';
  protected $namespace = '';
  protected $use = '';
  protected $tabs = 0;
  protected $tabsLength = 2;

  public function __construct($args)
  {
    $this->arguments = $args;
    $this->config();
  }

  /**
  * Code Format
  **/
  protected function addCode($code)
  {
    $this->code .= $this->applyTabs() . $code;
  }

  protected function addLineBreak($numb = 1)
  {
    for ($i=0; $i < $numb; $i++) {
      $this->code .= "\n";
    }
  }

  protected function applyTabs()
  {
    for ($i=0; $i < $this->tabs; $i++) {
      for ($i=0; $i < $this->tabsLength; $i++) {
        $this->code .= ' ';
      }
    }
  }

  protected function addTabs($numb = 1)
  {
    $this->tabs += $numb;
  }

  protected function removeTabs($numb = 1)
  {
    $this->tabs = $this->tabs - $numb > 0 ? $this->tabs - $numb : 0;
  }

  protected function initCode()
  {
    $this->addCode('<?php');
    $this->addLineBreak(2);
  }

  protected function addComments($comments)
  {
    $this->addCode('// ' . $comments);
  }

  /**
  * PHP Class
  **/
  protected function addClass($name, $extends = '', $implements = '')
  {
    $this->addCode('class ' . $name);

    if (!empty($extends))
      $this->addCode(' extends ' . $extends);
    if (!empty($implement))
      $this->addCode(' implements' . $implements);

    $this->addLineBreak();

    $this->addCode('{');
    $this->addLineBreak();
    $this->addTabs();
  }

  protected function closeClass()
  {
    $this->addLineBreak();
    $this->removeTabs();
    $this->addCode('}');
    $this->addLineBreak();
  }

  protected function addNamespace()
  {
    if (!empty($this->namespace)) {
      $this->addCode('namespace ' . $this->namespace . ';');
      $this->addLineBreak(2);
    }
  }

  protected function addUse()
  {
    if (!empty($this->use)) {
      foreach ($this->use as $value) {
        $this->addCode('use ' . $value . ';');
      }
      $this->addLineBreak(2);
    }
  }
}
