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
 * @version 2.1 - 2015-04-27
 * * Assertified the if statements that checked type.
 * @version 2.2 - 2015-05-07
 * * Repaired Get/Set Weight.
 * * Class is now fully tested.
 */
namespace TheWass\Grid\Types;

use TheWass\Grid\Grid;
use TheWass\Grid\Coordinate;
use TheWass\Grid\Cell;
/**
 * @class BaseGrid
 * @author The Wass
 * @brief Abstract class to facilitate constructing a grid
 * @description This is a basic template for implementing grid data structures.
 * The difference between a graph and a grid is graphs can dynamically connect and disconnect
 * nodes. Grid nodes have fixed neighbors which do not change.
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
        //var_dump(class_parents("TheWass\Grid\Coordinates\\$coordinateSystem"));
        assert('in_array(\'TheWass\Grid\Coordinate\', class_parents($coordinateSystem))');
        $this->coordinateSystem = $coordinateSystem;
    }

    /**
     * @brief Validates if the coordinate is contained within the grid.
     * @param $coordinate - The coordinate to test
     * @return Boolean True if the coordinate lies within the grid; False if it does not.
     */
    abstract protected function isInGridRange(Coordinate $coordinate);

    ///////////SPLObjectStorage Overwrites//////////////
    final public function offsetSet($coordinate, $data = null)
    {
        assert('$coordinate instanceof $this->coordinateSystem');
        assert('$data instanceof TheWass\Grid\Cell');
        if ($this->isInGridRange($coordinate)) {
            parent::offsetSet($coordinate, clone $data);
        } else {
            throw new \RangeException("Coordinate is outside of the grid.");
        }
    }

    public function offsetGet($coordinate)
    {
        assert('$coordinate instanceof $this->coordinateSystem');
        if (!$this->offsetExists($coordinate)) {
            $data = new Cell();
            $this->offsetSet($coordinate, $data);
        }
        return clone parent::offsetGet($coordinate);
    }

    final public function attach($coordinate, $data = null)
    {
        $this->offsetSet($coordinate, $data);
    }

    //////////////////Grid Interface////////////////////////
    public function isAdjacent(Coordinate $source, Coordinate $destination)
    {
        return in_array($destination, $this->getNeighbors($source));
    }

    public function getNeighbors(Coordinate $coordinate)
    {
        return $coordinate->calculateNeighbors();
    }

    public function getCell(Coordinate $coordinate)
    {
        return $this->offsetGet($coordinate);
    }

    public function setCell(Coordinate $coordinate, Cell $data)
    {
        $this->offsetSet($coordinate, $data);
    }

    public function getWeight(Coordinate $source, Coordinate $destination)
    {
        if (!$this->isAdjacent($source, $destination)) {
            throw new \UnexpectedValueException("$destination is not adjacent to $source.");
        }
        //Since they are adjacent, if getWeight returns false, then the weight is 1.
        return ($this->getCell($source)->getWeight($destination)) ?: 1;
    }

    public function setWeight(Coordinate $source, Coordinate $destination, $weight)
    {
        if (!$this->isAdjacent($source, $destination)) {
            throw new \UnexpectedValueException("$destination is not adjacent to $source.");
        }
        $this->getCell($source)->setWeight($destination, $weight);
    }
}
