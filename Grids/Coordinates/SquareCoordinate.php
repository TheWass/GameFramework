<?php
/**
 * @file SquareCoordinate.php
 * @author The Wass
 * @brief This file defines a coordinate system which creates a square grid
 *
 * @version 1.0.0 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 */
namespace Wasser\GameFramework\Grids\Coordinates;
/**
 * @class SquareCoordinate
 * @author The Wass
 * @brief Class which tesselates into a square grid.
 * @description description
 */
class SquareCoordinate extends Coordinate
{
    protected $x;
    protected $y;

    public function calculateNeighbors()
    {
        return array(
            new SquareCoordinate($this->x + 1, $this->y),
            new SquareCoordinate($this->x, $this->y + 1),
            new SquareCoordinate($this->x - 1, $this->y),
            new SquareCoordinate($this->x, $this->y - 1)
        );
    }
}