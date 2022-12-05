<?php

namespace App\Site\Lib\Forms;

class FormInput extends AbstractFormElement
{
    protected string $type;
    protected ?string $name;
    protected ?string $placeholder;
    protected ?bool $required;
    protected ?string $value;
    protected ?bool $readonly;
    protected ?bool $disabled;
    protected ?int $maxlength;
    protected ?string $pattern;
    protected ?string $accept;

    /**
     * @param string $type
     * @param string|null $name
     * @param string|null $placeholder
     * @param bool|null $required
     * @param string|null $value
     * @param bool|null $readonly
     * @param bool|null $disabled
     * @param int|null $maxlength
     * @param string|null $pattern
     */
    public function __construct(string $type, ?string $name = null, ?string $placeholder = null, ?bool $required = null, ?string $value = null, ?bool $readonly = null, ?bool $disabled = null, ?int $maxlength = null, ?string $pattern = null, ?string $accept = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->value = $value;
        $this->readonly = $readonly;
        $this->disabled = $disabled;
        $this->maxlength = $maxlength;
        $this->pattern = $pattern;
        $this->accept = $accept;
    }


    public function __toString(): string
    {
        return "<input "
            .($this->id ? "id='$this->id' " : null)
            .($this->classes ? "class='$this->classes' " : null)
            .($this->type ? "type='$this->type' " : null)
            .($this->name ? "name='$this->name' " : null)
            .($this->placeholder ? "placeholder='$this->placeholder' " : null)
            .($this->required ? "required " : null)
            .($this->value ? "value='$this->value' " : null)
            .($this->readonly ? "readonly " : null)
            .($this->disabled ? "disabled " : null)
            .($this->maxlength ? "maxlength='$this->maxlength' " : null)
            .($this->pattern ? "pattern='$this->pattern' " : null)
            .($this->accept ? "accept='$this->accept' " : null)
            ."/>";
    }
}