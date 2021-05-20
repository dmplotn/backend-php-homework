<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

abstract class AbstractEditorCommand implements \SplSubject
{
    /**
     * @var \SplObserver|null
     */
    protected ?\SplObserver $observer;

    /**
     * @var string
     */
    protected string $errorMessage;

    abstract public function execute(Editor $editor, EditorHistory $history): void;

        /**
     * @param \SplObserver $observer
     *
     * @return void
     */
    public function attach(\SplObserver $observer): void
    {
        $this->observer = $observer;
    }

    /**
     * @param \SplObserver $observer
     *
     * @return void
     */
    public function detach(\SplObserver $observer): void
    {
        $this->observer = null;
    }

    /**
     * @return void
     */
    public function notify(): void
    {
        $this->observer->update($this);
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
