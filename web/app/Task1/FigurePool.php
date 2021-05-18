<?php

namespace Task1;

use Task1\Figures\AbstractFigure;

class FigurePool implements \Iterator
{
    /**
     * @var array
     */
    private array $availableItems = [];

    /**
     * @var array
     */
    private array $usedItems = [];


    //Iterator props

    /**
     * @var array
     */
    private array $keys = [];

    /**
     * @var int
     */
    private int $currentIndex = 0;


    /**
     * @return AbstractFigure
     */
    public function get(): AbstractFigure
    {
        if ($this->isAvailableItemsEmpty()) {
            $figure = FigureGenerator::generate();
            $this->addToUsedItems($figure);
        } else {
            $figure = $this->getFirstFromAvailableItems();
            $this->removeFromAvailableItems($figure);
            $this->addToUsedItems($figure);
        }

        $this->addKey($figure->getId());

        return $figure;
    }

    /**
     * @param AbstractFigure $figure
     *
     * @return void
     */
    public function release(AbstractFigure $figure): void
    {
        $this->removeFromUsed($figure);
        $this->addToAvailableItems($figure);

        $this->addKey($figure->getId());
    }

    /**
     * @return bool
     */
    private function isAvailableItemsEmpty(): bool
    {
        return $this->availableItems === [];
    }

    /**
     * @return AbstractFigure
     */
    private function getFirstFromAvailableItems(): AbstractFigure
    {
        return current($this->availableItems);
    }

    /**
     * @param AbstractFigure $figure
     *
     * @return void
     */
    private function addToAvailableItems(AbstractFigure $figure): void
    {
        $this->availableItems[$figure->getId()] = $figure;
    }

    /**
     * @param AbstractFigure $figure
     *
     * @return void
     */
    private function addToUsedItems(AbstractFigure $figure): void
    {
        $this->usedItems[$figure->getId()] = $figure;
    }

    /**
     * @param AbstractFigure $figure
     *
     * @return void
     */
    private function removeFromAvailableItems(AbstractFigure $figure): void
    {
        unset($this->availableItems[$figure->getId()]);
    }

    /**
     * @param AbstractFigure $figure
     *
     * @return void
     */
    private function removeFromUsed(AbstractFigure $figure): void
    {
        unset($this->usedItems[$figure->getId()]);
    }


    //Iterator methods

    /**
     * @param string $key
     *
     * @return void
     */
    public function addKey(string $key): void
    {
        if (!in_array($key, $this->keys)) {
            $this->keys[] = $key;
        }
    }

    /**
     * @return string|null
     */
    public function key(): ?string
    {
        return $this->keys[$this->currentIndex] ?? null;
    }

    public function current()
    {
        return $this->availableItems[$this->key()] ?? $this->usedItems[$this->key()];
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->current() !== null;
    }

    /**
     * @return void
     */
    public function next(): void
    {
        $this->currentIndex += 1;
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->currentIndex = 0;
    }
}
