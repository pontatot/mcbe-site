<?php

namespace App\Site\Lib\Forms;

abstract class AbstractFormElement
{
    protected ?string $id = null;
    protected ?string $classes = null;
    public function setId(string $id) : AbstractFormElement {
        $this->id = $id;
        return $this;
    }
    public function addClass(string $class) : AbstractFormElement {
        $this->classes .= $class . ' ';
        return $this;
    }
    public abstract function __toString() : string;
}