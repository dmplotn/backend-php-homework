<?php

namespace Task1;

use Task1\Figures\AbstractFigure;

class FigurePool
{
    private array $availableItems = [];
    private array $usedItems = [];

    public function get(): AbstractFigure
    {
        if ($this->isAvailableItemsEmpty()) {
            $figure = FigureGenerator::generate();
            $this->addToUsedItems($figure);
            return $figure;
        }

        $figure = $this->getFirstFromAvailableItems();
        $this->removeFromAvailableItems($figure);
        $this->addToUsedItems($figure);
        return $figure;
    }

    public function release(AbstractFigure $figure): void
    {
        $this->removeFromUsed($figure);
        $this->addToAvailableItems($figure);
    }

    public function isAvailableItemsEmpty(): bool
    {
        return $this->availableItems === [];
    }

    private function getFirstFromAvailableItems(): AbstractFigure
    {
        return current($this->availableItems);
    }

    private function addToAvailableItems(AbstractFigure $figure): void
    {
        $this->availableItems[$figure->getId()] = $figure;
    }

    private function addToUsedItems(AbstractFigure $figure): void
    {
        $this->usedItems[$figure->getId()] = $figure;
    }

    private function removeFromAvailableItems(AbstractFigure $figure): void
    {
        unset($this->availableItems[$figure->getId()]);
    }

    private function removeFromUsed(AbstractFigure $figure): void
    {
        unset($this->usedItems[$figure->getId()]);
    }
}
