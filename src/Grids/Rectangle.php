<?php
/**
 * @file Rectangle.php
 * @author The Wass
 * @brief This file defines square grid
 *
 * @version 1.0 - 2015-03-18
 * * Initial Version
 *
 * @version 1.1 - 2015-03-23
 * * Modified Class to match the changes to abstract Grid.
 */
namespace TheWass\GameFramework\Grids;

use TheWass\GameFramework\Grids\Coordinates\Square;
/**
 * @class Rectangle
 * @author The Wass
 * @brief Rectangle grid with square cells.
 * @description description
 */
class Rectangle extends Grid
{
    protected $width;
    protected $height;

    /**
     * @brief Creates a rectangle grid
     * @param $width  - Maximum width  - 0 is infinite
     * @param $height - Maximum height - 0 is infinite
     * @return rectangle grid object
     */
    public function __construct($width = 0, $height = 0)
    {
        parent::__construct('Square');
    }

    public function offsetSet(Square $coordinate, $data)
    {
        if ((abs($coordinate->x) > $width and $width != 0) or
            (abs($coordinate->y) > $height and $height != 0)) {
            throw new RangeException("Coordinate is outside of the grid.");
        }
        parent::offsetSet($coordinate, $data);
    }

    public function attach(Square $coordinate, $data)
    {
        $this->offsetSet($coordinate, $data);
    }
}
