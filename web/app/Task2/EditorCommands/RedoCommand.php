<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

class RedoCommand extends AbstractEditorCommand
{
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
}
