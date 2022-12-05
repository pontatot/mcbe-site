<?php

namespace App\Site\Lib\Forms;

class Form extends AbstractFormElement
{
    private ?string $action;
    private ?string $target;
    private ?string $method;
    private ?bool $autocomplete;
    private ?string $submit;
    private array $elements;

    /**
     * @param string|null $action
     * @param string|null $submit
     * @param ?string $target
     * @param ?string $method
     * @param bool $autocomplete
     */
    public function __construct(?string $action = null, ?string $submit = null, ?string $method = null, bool $autocomplete = null, ?string $target = null, AbstractFormElement ... $elements)
    {
        $this->action = $action;
        $this->target = $target;
        $this->autocomplete = $autocomplete;
        $this->method = $method;
        $this->submit = $submit;
        $this->elements = $elements;
    }

    public function addElement(AbstractFormElement ...$elements) : Form {
        $this->elements = array_merge($this->elements, $elements);
        return $this;
    }

    public function __toString() : string {
        $result =  "<form "
            .($this->action ? "action='$this->action' " : null)
            .($this->id ? "for='$this->id' " : null)
            .($this->classes ? "class='$this->classes' " : null)
            .($this->target ? "target='$this->target' " : null)
            .($this->method ? "method='$this->method' " : null)
            .($this->method == 'post' ? "enctype='multipart/form-data' " : null)
            .($this->autocomplete ? "autocomplete='on' " : null)
            .">";
        foreach ($this->elements as $element) $result .= "<p>$element</p>";
        return $result
            .($this->submit ? "<p><input type='submit' value='$this->submit'></p>" : null)
            ."</form>";
    }


}