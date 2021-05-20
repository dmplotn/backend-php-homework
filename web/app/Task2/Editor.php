<?php

namespace Task2;

class Editor
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
    public function __construct(string $content, string $buffer)
    {
        $this->content = $content;
        $this->buffer = $buffer;
    }

    /**
     * @return EditorState
     */
    public function createState(): EditorState
    {
        return new EditorState($this->content, $this->buffer);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getBuffer(): string
    {
        return $this->buffer;
    }

    /**
     * @param string $buffer
     *
     * @return void
     */
    public function setBuffer(string $buffer): void
    {
        $this->buffer = $buffer;
    }
}
