<?php

namespace Task1;

use Task1\Figures\AbstractFigure;

class FigureGenerator
{
    private const CLASS_NAMES = [
        'Task1\Figures\Circle',
        'Task1\Figures\Sphere',
        'Task1\Figures\Rectangle',
        'Task1\Figures\Cuboid',
    ];

    /**
     * @return string
     */
    private static function getRandomClassName(): string
    {
        $index = array_rand(self::CLASS_NAMES, 1);
        return self::CLASS_NAMES[$index];
    }

    /**
     * @return AbstractFigure
     */
    public static function generate(): AbstractFigure
    {
        $className = self::getRandomClassName();
        $figure = new $className();

        return $figure;
    }
}
