<?php
/**
 * @file Pyramid.php
 * @author The Wass
 * @brief This file defines a coordinate system which creates a Pyramid
 *
 * @version 1.0 - 2015-03-13
 * * Initial version
 */
namespace TheWass\Grid\Coordinates;

use TheWass\Grid\Coordinate;
/**
 * @class Square
 * @author The Wass
 * @brief Class which tesselates into a Pyramid-like grid.
 * @description description
 */
class Pyramid extends Coordinate
{
    protected $x;
    protected $y;
    protected $level;

    public function validate($property, $value)
    {
        if (strtolower($property) == 'level') {
            return (is_int($value) and $value >= 0);
        } else {
            return is_int($value);
        }
    }

    protected function calculateNeighbors()
    {
        return array(
            new Pyramid($this->x - 1, $this->y - 1, $this->level - 1),
            new Pyramid($this->x - 0, $this->y - 1, $this->level - 1),
            new Pyramid($this->x - 1, $this->y - 0, $this->level - 1),
            new Pyramid($this->x - 0, $this->y - 0, $this->level - 1),
            new Pyramid($this->x - 1, $this->y - 0, $this->level - 0),
            new Pyramid($this->x - 0, $this->y - 1, $this->level - 0),
            new Pyramid($this->x + 0, $this->y + 1, $this->level + 0),
            new Pyramid($this->x + 1, $this->y + 0, $this->level + 0),
            new Pyramid($this->x + 0, $this->y + 0, $this->level + 1),
            new Pyramid($this->x + 1, $this->y + 0, $this->level + 1),
            new Pyramid($this->x + 0, $this->y + 1, $this->level + 1),
            new Pyramid($this->x + 1, $this->y + 1, $this->level + 1)
        );
    }
}
