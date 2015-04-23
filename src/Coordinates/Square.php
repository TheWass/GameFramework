<?php
/**
 * @file Square.php
 * @author The Wass
 * @brief This file defines a coordinate system which creates a square grid
 *
 * @version 1.0 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 */
namespace TheWass\Grid\Coordinates;

use TheWass\Grid\Coordinate;
/**
 * @class Square
 * @author The Wass
 * @brief Class which tesselates into a square grid.
 * @description description
 */
class Square extends Coordinate
{
    protected $x;
    protected $y;

    public function calculateNeighbors()
    {
        return array(
            new Square($this->x + 1, $this->y),
            new Square($this->x - 1, $this->y),
            new Square($this->x, $this->y + 1),
            new Square($this->x, $this->y - 1)
        );
    }
}
