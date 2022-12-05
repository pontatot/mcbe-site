<?php

namespace App\Site\Lib\Forms;

class LabelledFormElement extends AbstractFormElement
{
    private FormLabel $label;
    private AbstractFormElement $element;

    /**
     * @param string $label
     * @param AbstractFormElement $element
     * @param ?string $id
     */
    public function __construct(string $label, AbstractFormElement $element, ?string $id = null)
    {
        $this->label = new FormLabel($label);
        $this->element = $element;
        if ($id) $this->setId($id);
    }


    public function __toString(): string
    {
        return $this->label . ' ' . $this->element;
    }

    public function setId(string $id): LabelledFormElement
    {
        $this->label->setId($id);
        $this->element->setId($id);
        return $this;
    }
}