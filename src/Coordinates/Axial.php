<?php
/**
 * @file Axial.php
 * @author The Wass
 * @brief This file defines a coordinate system which creates a Hex grid
 *
 * @version 1.0 - 2015-03-18
 * * Initial version
 */
namespace TheWass\Grid\Coordinates;

use TheWass\Grid\Coordinate;
/**
 * @class Axial
 * @author The Wass
 * @brief Class which tesselates into a Hex grid.
 * @description description
 * @property-read integer $x
 * @property-read integer $y
 */
class Axial extends Coordinate
{
    protected $x;
    protected $y;

    public function calculateNeighbors()
    {
        return array(
            new Axial($this->x + 1, $this->y),
            new Axial($this->x - 1, $this->y),
            new Axial($this->x, $this->y + 1),
            new Axial($this->x, $this->y - 1),
            new Axial($this->x - 1, $this->y + 1),
            new Axial($this->x + 1, $this->y - 1)
        );
    }

    public function toHexCube()
    {
        $z = 0 - $this->x - $this->y;
        return new HexCube($this->x, $this->y, $z);
    }
}
