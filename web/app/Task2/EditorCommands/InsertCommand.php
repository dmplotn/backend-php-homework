<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

class InsertCommand implements EditorCommandInterface
{
    /**
     * @var string
     */
    private string $str;

    /**
     * @var int
     */
    private int $idx;

    /**
     * @param string $str
     * @param int $idx
     */
    public function __construct(string $str, int $idx)
    {
        if ($idx < 0) {
            throw new \DomainException();
        }

        $this->str = $str;
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
        $content = $editor->getContent();
        $substr1 = mb_substr($content, 0, $this->idx);
        $substr2 = mb_substr($content, $this->idx);
        $newContent = "{$substr1}{$this->str}{$substr2}";
        $editor->setContent($newContent);

        $history->addState($editor->createState());
    }
}
