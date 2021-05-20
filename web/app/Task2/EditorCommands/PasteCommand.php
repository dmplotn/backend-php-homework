<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

class PasteCommand implements EditorCommandInterface
{
    /**
     * @var int
     */
    private int $idx;

    /**
     * @param int $idx
     */
    public function __construct(int $idx)
    {
        if ($idx < 0) {
            throw new \DomainException();
        }

        $this->idx = $idx;
    }

    /**
     * @param Editor $editor
     * @param EditorHistory $history
     *
     * @return void
     */
    public function execute(Editor $editor, EditorHistory $history): void
    {
        $buffer = $editor->getBuffer();

        if ($buffer === '') {
            throw new \DomainException();
        }

        $content = $editor->getContent();
        $substr1 = mb_substr($content, 0, $this->idx);
        $substr2 = mb_substr($content, $this->idx);
        $newContent = "{$substr1}{$buffer}{$substr2}";
        $editor->setContent($newContent);
        $editor->setBuffer('');

        $history->addState($editor->createState());
    }
}
