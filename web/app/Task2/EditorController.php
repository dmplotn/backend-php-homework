<?php

namespace Task2;

class EditorController
{
    /**
     * @var \SplObserver
     */
    private \SplObserver $observer;

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

        $this->observer = new ErrorObserver();

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
        if ($commands === []) {
            throw new \DomainException('Список команд пуст.');
        }

        foreach ($commands as $command) {
            $command->attach($this->observer);
        }

        foreach ($commands as $command) {
            $command->execute($this->editor, $this->history);
        }
    }
}
