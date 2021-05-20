<?php

namespace Task2;

class EditorState
{
    /**
     * @var string
     */
    private string $content;

    /**
     * @var string
     */
    private string $buffer;

    /**
     * @param string $content
     * @param string $buffer
     */
    public function __construct(string $content = '', string $buffer = '')
    {
        $this->content = $content;
        $this->buffer = $buffer;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getBuffer(): string
    {
        return $this->buffer;
    }
}
