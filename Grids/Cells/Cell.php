<?php
/**
 * @file Cell.php
 * @author The Wass
 * @brief This file defines a template for a single cell of a grid.
 * 
 * @todo Make this into a real class which just grabs cell definitions from a file,
 * and dynamically creates the chosen cell
 *
 * @version 1.0.0 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 */
namespace Wasser\GameFramework\Grids\Cells;
/**
 * @class Cell
 * @author The Wass
 * @brief Abstract class to facilitate constructing a cell and validating a coordinate for it.
 * @description description
 */
abstract class Cell
{
    private $coordinates;

    final public function __construct($coords)
    {
        if (in_array('Coordinate', class_parents($coords)) {
            $this->coordinates = $coords;
        } else {
            throw new InvalidArgumentException("$coords must extend the Coordinate class.");
        }
    }

    final protected function getCoordinates()
    {
        if (func_num_args() == 0) {
            return $this->coordinates;
        } else {
            return $this->coordinates->func_get_arg(0);
        }
    }

    public function getNeighbors()
    {
        return $this->getCoordinates()->calculateNeighbors();
    }
}