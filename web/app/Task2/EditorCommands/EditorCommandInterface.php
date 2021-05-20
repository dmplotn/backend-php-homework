<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

interface EditorCommandInterface extends \SplSubject
{
    /**
     * @param Editor $editor
     * @param EditorHistory $history
     *
     * @return void
     */
    public function execute(Editor $editor, EditorHistory $history): void;
}
