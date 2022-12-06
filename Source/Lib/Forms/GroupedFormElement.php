<?php

namespace App\Site\Lib\Forms;

class GroupedFormElement extends AbstractFormElement
{
    private array $elements;

    /**
     * @param array $elements
     */
    public function __construct(AbstractFormElement ...$elements)
    {
        $this->elements = $elements;
    }

    public function addElement(AbstractFormElement ...$elements) : GroupedFormElement {
        $this->elements = array_merge($this->elements, $elements);
        return $this;
    }


    public function __toString(): string
    {
        $result = '';
        foreach ($this->elements as $element) $result .= $element . ' ';
        return $result;
    }
}