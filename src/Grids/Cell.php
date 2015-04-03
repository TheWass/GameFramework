<?php
/**
 * @file Cell.php
 * @author The Wass
 * @brief This file defines a standard, extensible Cell
 *
 * @version 1.0 - 2015-04-03
 * * Initial Version
 */
namespace TheWass\GameFramework\Grids;

use TheWass\GameFramework\Grids\Coordinates\Coordinate;
/**
 * @class Cell
 * @author The Wass
 * @brief Data container object.
 * @description This container also handles storing and getting the neighboring cell coordinates.
 * The neighbors cannot be checked for validity.  That will be done in the grid.
 * The neighbors are only stored if the weight is not the default (1).
 * Weights cannot be 0 or negative.
 */
class Cell
{
    private $neighbors;
    private $data;

    public function __construct()
    {
        $this->neighbors = new \SplObjectStorage();
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @brief Sets the neighbor's weight
     * @param $coordinate - Neighboring coordinate
     * @param $value      - The weight
     * @return The set weight on success or false on failure.
     */
    public function setWeight(Coordinate $coordinate, $value)
    {
        if ($value > 1) {
            $this->neighbors[$coordinate] = $value;
            return $value;
        } else if ($value == 1 or $value == 0) {
            unset($this->neighbors[$coordinate];
            return 1;
        } else {
            return false;
        }
    }

    /**
     * @brief Gets the neighbor's weight
     * @param $coordinate - Neighboring coordinate
     * @return The set weight or false if not in the list.
     */
    public function getWeight(Coordinate $coordinate)
    {
        if ($this->neighbors()->contains($coordinate) {
            return $this->neighbors[$coordinate];
        } else {
            return false;
        }
    }
}
