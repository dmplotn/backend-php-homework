<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

class UndoCommand extends AbstractEditorCommand
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
        if ($history->getPosition() >= $history->count() - 1) {
            $this->errorMessage = 'Команда undo не может быть выполнена.';
            $this->notify();
        }

        $history->shiftPosition();
        $newContent = $history->getCurrentState()->getContent();
        $editor->setContent($newContent);
    }
}
