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
    private $cellType;
    private $coordinateSystem;

    /**
     * @brief Constructor for the grid.
     * @param $cellType         - String representing the chosen Cell class
     * @param $coordinateSystem - String of the desired Coordinate class
     */
    public function __construct($cellType, $coordinateSystem)
    {
        if (in_array('Cell', class_parents($cellType))) {
            $this->cellType = $cellType;
            if (in_array('Coordinate', class_parents($coordinateSystem))) {
                $this->coordinateSystem = $coordinateSystem;
                parent::__construct();
            } else {
                throw new InvalidArgumentException("$coordinateSystem must extend the Coordinate class.");
            }
        } else {
            throw new InvalidArgumentException("$cellType must extend the Cell class.");
        }
    }

    ///////////SPLObjectStorage Overwrites//////////////
    public function offsetSet(Coordinate $coordinate, Cell $data)
    {
        if (is_a($coordinate, $this->coordinateSystem)) {
            if (is_a($data, $this->cellType)) {
                parent::offsetSet($coordinate, $data);
            } else {
                throw new InvalidArgumentException("$data must be a $cellType.");
            }
        } else {
            throw new InvalidArgumentException("$coordinate must be a $coordinateSystem");
        }
    }

    public function attach(Coordinate $coordinate, Cell $data)
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

    public function setNode(Coordinate $coordinate, Cell $data)
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

    //Weight information is controlled by the children of this class.
    /**
     * @brief Gets the weight of the edge connecting two cells
     * @param $coordinate1 - Source location
     * @param $coordinate2 - Destination location
     * @return Integer denoting the edge weight
     */

    abstract public function getWeight($coordinate1, $coordinate2);
    /**
     * @brief Sets the weight of the edge connecting two cells
     * @param $coordinate1  - Source location
     * @param $coordinate2  - Destination location
     * @param $weight - Desired weight
     * @return Boolean - Success or Failure
     */
    abstract public function setWeight($coordinate1, $coordinate2, $weight);
}
