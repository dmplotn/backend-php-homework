<?php

namespace Task2;

class EditorHistory
{
    /**
     * @var array
     */
    private array $states = [];

    /**
     * @var int
     */
    private int $position = 0;

    /**
     * @return void
     */
    public function shiftPosition(): void
    {
        if ($this->position < count($this->states) - 1) {
            $this->position += 1;
        }
    }

    /**
     * @return void
     */
    public function unshiftPosition(): void
    {
        if ($this->position > 0) {
            $this->position -= 1;
        }
    }

    /**
     * @param EditorState $state
     *
     * @return void
     */
    public function addState(EditorState $state): void
    {
        if ($this->position !== 0) {
            $this->removeStatesToCurrentPosition();
        }

        array_unshift($this->states, $state);
    }

    /**
     * @return EditorState
     */
    public function getCurrentState(): EditorState
    {
        return $this->states === [] ? new EditorState() : $this->states[$this->position];
    }

    /**
     * @return void
     */
    public function removeStatesToCurrentPosition(): void
    {
        $this->states = array_slice($this->states, $this->position);

        $this->position = 0;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->states);
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }
}
