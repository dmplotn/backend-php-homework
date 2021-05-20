<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

class DeleteCommand implements EditorCommandInterface
{
    /**
     * @var int
     */
    private int $idx1;

    /**
     * @var int
     */
    private int $idx2;

    /**
     * @param int $idx1
     * @param int $idx2
     */
    public function __construct(int $idx1, int $idx2)
    {
        if ($idx1 < 0 || $idx2 < 0 || $idx1 > $idx2) {
            throw new \DomainException();
        }

        $this->idx1 = $idx1;
        $this->idx2 = $idx2;
    }

    /**
     * @param Editor $editor
     * @param EditorHistory $history
     *
     * @return void
     */
    public function execute(Editor $editor, EditorHistory $history): void
    {
        $content = $editor->getContent();
        $substr1 = mb_substr($content, 0, $this->idx1);
        $substr2 = mb_substr($content, $this->idx2 + 1);
        $newContent = "{$substr1}{$substr2}";
        $editor->setContent($newContent);

        $history->addState($editor->createState());
    }
}
