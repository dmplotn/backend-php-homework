<?php

namespace Task2;

class ErrorObserver implements \SplObserver
{
    /**
     * @param \SplSubject $subject
     *
     * @return [type]
     */
    public function update(\SplSubject $subject)
    {
        throw new \DomainException($subject->getErrorMessage());
    }
}
