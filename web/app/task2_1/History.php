<?php

class History
{
    private const HISTORY_MAX_SIZE = 3;

    private $data;

    public function __construct()
    {
        $this->data = json_decode($_COOKIE['history'] ?? '{}', true);
    }

    private function getSize(): int
    {
        return count($this->data);
    }

    public function update(): void
    {
        $currentPageName = Pages::getCurrentPageName();
        $currentPath = Pages::getPathForCurrentPage();

        $addedItem = [$currentPath, $currentPageName];

        $lastPath = $this->data[$this->getSize() - 1][0] ?? null;

        if ($lastPath === $currentPath) {
            return;
        }

        $checkedItemIndex = $this->getSize() === self::HISTORY_MAX_SIZE ? 1 : 0;

        $checkedPath = array_slice($this->data, -2)[0][0];

        $this->data[] = $addedItem;

        if ($checkedPath === $currentPath) {
            unset($this->data[$checkedItemIndex]);
            $this->data = array_values($this->data);
            $this->save();
            return;
        }

        if ($this->getSize() > self::HISTORY_MAX_SIZE) {
            array_shift($this->data);
            $this->data = array_values($this->data);
        }

        $this->save();
    }

    private function save(): void
    {
        setCookie('history', json_encode($this->data), 0, "/task2_1/");
    }

    public function getReversedData(): array
    {
        return array_reverse($this->data);
    }
}
