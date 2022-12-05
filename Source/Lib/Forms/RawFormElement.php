<?php

namespace App\Site\Lib\Forms;

class RawFormElement extends AbstractFormElement
{

    protected string $content;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function __toString(): string
    {
        return $this->content;
    }
}