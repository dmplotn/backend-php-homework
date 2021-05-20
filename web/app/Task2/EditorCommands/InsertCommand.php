<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

class InsertCommand implements EditorCommandInterface
{
    /**
     * @var \SplObserver|null
     */
    private ?\SplObserver $observer;

    /**
     * @var string
     */
    private string $errorMessage;

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
            $this->errorMessage = 'Команда insert. Невалидный параметр.';
            $this->notify();
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

    /**
     * @param \SplObserver $observer
     *
     * @return void
     */
    public function attach(\SplObserver $observer): void
    {
        $this->observer = null;
    }

    /**
     * @param \SplObserver $observer
     *
     * @return void
     */
    public function detach(\SplObserver $observer): void
    {
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
