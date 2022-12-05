<?php

namespace App\Site\Lib\Forms;

class FormLabel extends AbstractFormElement
{
    private string $label;

    /**
     * @param string|null $id
     * @param string $label
     */
    public function __construct(string $label, ?string $id = null)
    {
        $this->label = $label;
        $this->id = $id;
    }


    public function __toString(): string
    {
        return "<label "
        .($this->id ? "for='$this->id' " : null)
        .($this->classes ? "class='$this->classes' " : null)
        .">$this->label </label>";
    }
}