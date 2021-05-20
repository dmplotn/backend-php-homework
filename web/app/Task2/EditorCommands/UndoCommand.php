<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

class UndoCommand implements EditorCommandInterface
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
            throw new \Exception();
        }

        $history->shiftPosition();
        $newContent = $history->getCurrentState()->getContent();
        $editor->setContent($newContent);
    }
}
