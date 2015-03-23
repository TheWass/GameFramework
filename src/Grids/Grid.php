<?php
/**
 * @file Grid.php
 * @author The Wass
 * @brief This file defines a template for a grid.
 *
 * @version 1.0 - 2015-03-02
 * * Initial Version
 *
 * @version 1.1 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 * * Fixed doxy-comments
 *
 * @version 1.2 - 2015-03-18
 * * Added parameters to keep track of the cell type and coordinate system
 * * Changed the weight set/get to work off of locations rather than cells.
 *
 * @version 1.3 - 2015-03-23
 * * Decoupled the Cell class.  The grid can now store any type of data.
 */
namespace TheWass\GameFramework\Grids;

use TheWass\GameFramework\Interfaces as Interfaces;
/**
 * @class Grid
 * @author The Wass
 * @brief Abstract class to facilitate constructing a grid
 * @description description
 */
abstract class Grid extends \SplObjectStorage implements Interfaces\Graph
{
    private $coordinateSystem;

    /**
     * @brief Constructor for the grid.
     * @param $coordinateSystem - String of the desired Coordinate class
     */
    public function __construct($coordinateSystem)
    {
        if (in_array('Coordinate', class_parents($coordinateSystem))) {
            $this->coordinateSystem = $coordinateSystem;
            parent::__construct();
        } else {
            throw new InvalidArgumentException("$coordinateSystem must extend the Coordinate class.");
        }
    }

    ///////////SPLObjectStorage Overwrites//////////////
    public function offsetSet(Coordinate $coordinate, $data)
    {
        if (is_a($coordinate, $this->coordinateSystem)) {
            parent::offsetSet($coordinate, $data);
        } else {
            throw new InvalidArgumentException("$coordinate must be a $coordinateSystem");
        }
    }

    public function attach(Coordinate $coordinate, $data)
    {
        $this->offsetSet($coordinate, $data);
    }

    ///////////GraphInterface implementation///////////
    public function isAdjacent(Coordinate $source, Coordinate $destination)
    {
        return in_array($destination, $source->getNeighbors());
    }

    public function getNeighbors(Coordinate $coordinate)
    {
        return $coordinate->getNeighbors();
    }

    public function getNode(Coordinate $coordinate)
    {
        return $this->offsetGet($coordinate);
    }

    public function setNode(Coordinate $coordinate, $data)
    {
        $this->offsetSet($coordinate, $data);
    }

    //Cannot manually connect or disconnect in a fixed grid.
    final public function connect($node1, $node2)
    {
        return false;
    }

    final public function disconnect($node1, $node2)
    {
        return false;
    }

    public function getWeight(Coordinate $source, Coordinate $destination)
    {
        return $source->getWeight($destination);
    }

    public function setWeight(Coordinate $source, Coordinate $destination, $weight)
    {
        return $source->getWeight($destination, $weight);
    }
}
