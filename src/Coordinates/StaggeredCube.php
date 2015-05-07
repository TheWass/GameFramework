<?php
/**
 * @file StaggeredCube.php
 * @author The Wass
 * @brief This file defines a coordinate system which creates a Staggered Cube
 *
 * @version 1.0 - 2015-03-13
 * * Initial version
 */
namespace TheWass\Grid\Coordinates;

use TheWass\Grid\Coordinate;
/**
 * @class Square
 * @author The Wass
 * @brief Class which tesselates into a StaggeredCube-like grid.
 * @description description
 * @property-read integer $x
 * @property-read integer $y
 * @property-read integer $z
 */
class StaggeredCube extends Coordinate
{
    protected $x;
    protected $y;
    protected $z;

    public function calculateNeighbors()
    {
        return array(
            new StaggeredCube($this->x - 1, $this->y - 1, $this->z - 1),
            new StaggeredCube($this->x - 0, $this->y - 1, $this->z - 1),
            new StaggeredCube($this->x - 1, $this->y - 0, $this->z - 1),
            new StaggeredCube($this->x - 0, $this->y - 0, $this->z - 1),
            new StaggeredCube($this->x - 1, $this->y - 0, $this->z - 0),
            new StaggeredCube($this->x - 0, $this->y - 1, $this->z - 0),
            new StaggeredCube($this->x + 0, $this->y + 1, $this->z + 0),
            new StaggeredCube($this->x + 1, $this->y + 0, $this->z + 0),
            new StaggeredCube($this->x + 0, $this->y + 0, $this->z + 1),
            new StaggeredCube($this->x + 1, $this->y + 0, $this->z + 1),
            new StaggeredCube($this->x + 0, $this->y + 1, $this->z + 1),
            new StaggeredCube($this->x + 1, $this->y + 1, $this->z + 1)
        );
    }
}
