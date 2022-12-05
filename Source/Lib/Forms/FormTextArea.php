<?php

namespace App\Site\Lib\Forms;

class FormTextArea extends FormInput
{


    public function __construct(string $name, string $placeholder, bool $required = null, ?string $value = null, ?bool $readonly = null, ?bool $disabled = null, ?int $maxlength = null, ?string $pattern = null)
    {
        parent::__construct('', $name,  $placeholder,  $required, $value, $readonly, $disabled, $maxlength, $pattern);
    }

    public function __toString(): string
    {
        return "<textarea "
            .($this->id ? "id='$this->id' " : null)
            .($this->classes ? "class='$this->classes' " : null)
            .($this->name ? "name='$this->name' " : null)
            .($this->placeholder ? "placeholder='$this->placeholder' " : null)
            .($this->required ? "required " : null)
            .($this->readonly ? "readonly " : null)
            .($this->disabled ? "disabled " : null)
            .($this->maxlength ? "maxlength='$this->maxlength' " : null)
            .($this->pattern ? "pattern='$this->pattern' " : null)
            .">"
            .($this->value ? "$this->value" : null)
            ."</textarea>";
    }
}