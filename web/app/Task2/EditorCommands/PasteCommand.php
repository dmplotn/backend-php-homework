<?php

namespace Task2\EditorCommands;

use Task2\Editor;
use Task2\EditorHistory;

class PasteCommand implements EditorCommandInterface
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
     * @var int
     */
    private int $idx;

    /**
     * @param int $idx
     */
    public function __construct(int $idx)
    {
        if ($idx < 0) {
            throw new \DomainException('Команда paste. Невалидный параметр.');
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
            $this->errorMessage = 'Команда paste. Пустой буффер.';
            $this->notify();
        }

        $content = $editor->getContent();

        if ($this->idx > mb_strlen($content)) {
            $this->errorMessage = 'Команда paste. Невалидный параметр.';
            $this->notify();
        }

        $substr1 = mb_substr($content, 0, $this->idx);
        $substr2 = mb_substr($content, $this->idx);
        $newContent = "{$substr1}{$buffer}{$substr2}";
        $editor->setContent($newContent);
        $editor->setBuffer('');

        $history->addState($editor->createState());
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
