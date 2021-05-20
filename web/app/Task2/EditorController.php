<?php

namespace Task2;

use SplSubject;

class EditorController implements \SplObserver
{
    /**
     * @var Editor
     */
    private Editor $editor;

    /**
     * @var EditorHistory
     */
    private EditorHistory $history;

    public function __construct()
    {
        $history = new EditorHistory();
        $this->history = $history;

        $state = $this->history->getCurrentState();
        $content = $state->getContent();
        $buffer = $state->getBuffer();

        $this->editor = new Editor($content, $buffer);
        $history->addState($this->editor->createState());
    }

    /**
     * @return string
     */
    public function getEditorContent(): string
    {
        return $this->editor->getContent();
    }

    /**
     * @return EditorHistory
     */
    public function getHistory(): EditorHistory
    {
        return $this->history;
    }

    /**
     * @param array $commands
     *
     * @return void
     */
    public function process(array $commands): void
    {
        foreach ($commands as $command) {
            // $command->execute($this->editor, $this->history);
            $command->attach($this);
        }

        foreach ($commands as $command) {
            $command->execute($this->editor, $this->history);
        }
    }

    /**
     * @param \SplSubject $subject
     *
     * @return void
     */
    public function update(\SplSubject $subject): void
    {
        throw new \DomainException($subject->getErrorMessage());
    }
}
