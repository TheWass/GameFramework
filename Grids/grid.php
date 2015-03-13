<?php
/**
 * @file grid.php
 * @author Wass
 * @brief Brief
 * @details Details
 * 
 * @version 1.0.0 - 2015-03-02
 * * Initial Version
 */
 
/**
 * @class Example
 * @author Full Name
 * @brief This is a short description of the class
 * @description To show code examples, separate the code block with blank lines 
 */
abstract class Grid extends SplObjectStorage implements GraphInterface
{
    /**
     * @brief Brief
     * @param [in] $cellType Parameter_Description
     * @return Return_Description
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
    public function connect($node1, $node2)
    {
        return false;
    }

    public function disconnect($node1, $node2)
    {
        return false;
    }

    //Weight information is controlled by the children of this class.
    abstract public function getWeight($cell1, $cell2);
    abstract public function setWeight($cell1, $cell2, $weight);

}
/**
 *  Every declared cell will have an immutable, unique set of coordinates.
 *  These coordinates function as the ID for the cell, not the thing the cell contains.
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
/**
 *  When using this trait, all properties will become coordinate labels in the declared order.
 *  Make sure all properties of the using class are protected.
 */
abstract class Coordinate
{
    public function __construct()
    {
        //Get list of property names
        $properties = array_keys(get_class_vars(__CLASS__));
        //combine arrays so $property => $value
        if (($toAssign = array_combine($properties, func_get_arg($i)))) {
            //Set properties
            foreach ($toAssign as $prop=>$val) {
                if (is_int($val)) {
                    $this->$prop = $val;
                } else {
                    throw new InvalidArgumentException("$prop must be an integer!");
                }
            }
        } else {
            throw new InvalidArgumentException("Invalid number of arguments passed.  Need ". count($properties));
        }
    }

    public function __get($name)
    {
        if (in_array($name, array_keys(get_class_vars(__CLASS__)))) {
            return $this->$name;
        } else {
            throw new BadMethodCallException("$name is not a valid property.");
        }
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function __toString()
    {
        return '(' . implode(', ', $this->toArray()) . ')';
    }

    abstract public function calculateNeighbors();
}