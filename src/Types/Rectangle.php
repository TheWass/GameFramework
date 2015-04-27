<?php
/**
 * @file Rectangle.php
 * @author The Wass
 * @brief This file defines square grid
 *
 * @version 1.0 - 2015-03-18
 * * Initial Version
 * @version 1.1 - 2015-03-23
 * * Modified Class to match the changes to abstract Grid.
 */
namespace TheWass\Grid\Types;

use TheWass\Grid\Coordinates\Square as SquareCoordinate;
/**
 * @class Rectangle
 * @author The Wass
 * @brief Rectangle grid with square cells.
 * @description description
 */
class Rectangle extends BaseGrid
{
    protected $width;
    protected $height;

    /**
     * @brief Creates a rectangle grid
     * @param $width  - Maximum width  - 0 is infinite
     * @param $height - Maximum height - 0 is infinite
     */
    public function __construct($width = 0, $height = 0)
    {
        parent::__construct('Square');
        $this->width = $width;
        $this->height = $height;
    }

    protected function isInGridRange(SquareCoordinate $coordinate)
    {
        return ((abs($coordinate->x) <= $this->width || $this->width == 0) &&
                (abs($coordinate->y) <= $this->height || $this->height == 0));
    }
}
