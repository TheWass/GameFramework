<?php
/**
 * @file BaseGrid.php
 * @author The Wass
 * @brief This file defines a template for a grid.
 *
 * @version 1.0 - 2015-03-02
 * * Initial Version
 * @version 1.1 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 * * Fixed doxy-comments
 * @version 1.2 - 2015-03-18
 * * Added parameters to keep track of the cell type and coordinate system
 * * Changed the weight set/get to work off of locations rather than cells.
 * @version 1.3 - 2015-03-23
 * * Decoupled the Cell class.  The grid can now store any type of data.
 * @version 2.0 - 2015-04-03
 * * Readded the Cell class, but left it mostly decoupled.
 * * The cell stores the neighbors' weights and the cell data.
 */
namespace TheWass\Grid\Types;

use TheWass\Grid\Grid;
use TheWass\Grid\Coordinate;
use TheWass\Grid\Cell;
/**
 * @class BaseGrid
 * @author The Wass
 * @brief Abstract class to facilitate constructing a grid
 * @description description
 */
abstract class BaseGrid extends \SplObjectStorage implements Grid
{
    private $coordinateSystem; //used to ensure coordinates are all of the same type.

    /**
     * @brief Constructor for the grid.
     * @param $coordinateSystem - String of the desired Coordinate class
     */
    public function __construct($coordinateSystem)
    {
        if (in_array('TheWass\Grid\Coordinate', class_parents($coordinateSystem))) {
            $this->coordinateSystem = $coordinateSystem;
        } else {
            throw new \InvalidArgumentException("$coordinateSystem must extend the Coordinate class.");
        }
    }

    /**
     * @brief Validates if the coordinate is contained within the grid.
     * @param $coordinate - The coordinate to test
     * @return Boolean True if the coordinate lies within the grid; False if it does not.
     */
    abstract protected function isInGrid(Coordinate $coordinate);

    ///////////SPLObjectStorage Overwrites//////////////
    final public function offsetSet($coordinate, $data = null)
    {
        if ($coordinate instanceof $this->coordinateSystem) {
            if (isInGrid($coordinate)){
                parent::offsetSet($coordinate, $data);
            } else {
                throw new RangeException("Coordinate is outside of the grid.");
            }
        } else {
            throw new \InvalidArgumentException("$coordinate must be a {$this->coordinateSystem}");
        }
    }

    final public function attach($coordinate, $data = null)
    {
        $this->offsetSet($coordinate, $data);
    }

    ///////////GraphInterface implementation///////////
    public function isAdjacent(Coordinate $source, Coordinate $destination)
    {
        return in_array($destination, $source->calculateNeighbors());
    }

    public function getNeighbors(Coordinate $coordinate)
    {
        return $coordinate->calculateNeighbors();
    }

    public function getNode(Coordinate $coordinate)
    {
        return $this->offsetGet($coordinate);
    }

    public function setNode(Coordinate $coordinate, $data)
    {
        $this->offsetSet($coordinate, $data);
    }

    public function getWeight(Cell $source, Coordinate $destination)
    {
        return $source->getWeight($destination);
    }

    public function setWeight(Cell $source, Coordinate $destination, $weight)
    {
        return $source->setWeight($destination, $weight);
    }
}
