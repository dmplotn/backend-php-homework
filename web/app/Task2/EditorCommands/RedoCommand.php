<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

class RedoCommand implements EditorCommandInterface
{
    /**
     * @var \SplObserver|null
     */
    private ?\SplObserver $observer;

    /**
     * @var string
     */
    private string $errorMessage;

    public function __construct()
    {
    }

    /**
     * @param Editor $editor
     * @param EditorHistory $history
     *
     * @return void
     */
    public function execute(Editor $editor, EditorHistory $history): void
    {
        if ($history->getPosition() === 0) {
            $this->errorMessage = 'Команда redo не может быть выполнена.';
            $this->notify();
        }

        $history->unshiftPosition();
        $newContent = $history->getCurrentState()->getContent();
        $editor->setContent($newContent);
    }

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
