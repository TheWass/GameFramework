<?php
namespace TheWass\GameFramework\Grids;
/**
 * @file grid.php
 * @author Wass
 * @brief This file defines a template for a grid.
 *
 * @version 1.0.0 - 2015-03-02
 * * Initial Version
 * @version 1.0.1 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 * * Fixed doxy-comments
 */

/**
 * @class Grid
 * @author The Wass
 * @brief Abstract class to facilitate constructing a grid
 * @description description
 */
abstract class Grid extends SplObjectStorage implements GraphInterface
{
    /**
     * @brief Brief
     * @param $cellType - Cell class name or object that this grid will be.
     * @return new Grid object
     */
    public function __construct($cellType)
    {
        if (!in_array('Cell', class_parents($cellType)) {
            parent::__construct();
        } else {
            trigger_error("$cellType must extend the Cell class.", E_USER_ERROR);
        }
    }

    ///////////SPLObjectStorage Overwrites//////////////
    public function offsetSet(Coordinate $coordinate, $data = null)
    {
        if (in_array('Coordinate', class_parents($coordinate)) {
            parent::offsetSet(Coordinate $coordinate, $data);
        } else {
            throw new InvalidArgumentException("$coordinate must extend the Coordinate class.");
        }
    }

    public function attach(Coordinate $coordinate, $data = null)
    {
        $this->offsetSet($coordinate, $data);
    }

    ///////////GraphInterface implementation///////////
    public function isAdjacent(Coordinate $coordinate1, Coordinate $coordinate2)
    {
        return in_array($coordinate2, $coordinate1->calculateNeighbors());
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
        try {
            $this->offsetSet($coordinate, $data);
            return true;
        } catch (InvalidArgumentException $e) {
            trigger_error($e, E_USER_WARNING);
            return false;
        }
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

    //Weight information is controlled by the children of this class.
    /**
     * @brief Gets the weight of the edge connecting two cells
     * @param $cell1 - Source Cell
     * @param $cell2 - Destination Cell
     * @return Integer denoting the edge weight
     */

    abstract public function getWeight($cell1, $cell2);
    /**
     * @brief Brief
     * @param $cell1  - Source Cell
     * @param $cell2  - Destination Cell
     * @param $weight - Desired weight
     * @return Boolean - Success or Failure
     */
    abstract public function setWeight($cell1, $cell2, $weight);
}
