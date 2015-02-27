<?php
abstract class Grid extends SplObjectStorage implements GraphInterface
{
    /**
     *  Constructs a regular grid
     *  Must pass in the name of a class which extends the Cell class.
     */
    public function __construct($cellType)
    {
        if (!in_array('Cell', class_parents($cellType)) {
            parent::__construct();
        } else {
            throw new InvalidArgumentException("$cellType must extend the Cell class.");
        }
    }

    ///////////SPLObjectStorage Overwrites//////////////
    public function offsetSet($coordinate, $data = null)
    {
        if (in_array('Coordinate', class_uses($coordinate)) {
            parent::offsetSet($coordinate, $data);
        } else {
            throw new InvalidArgumentException("The offset object must have the Coordinate trait.");
        }
    }

    public function attach($coordinate, $data = null)
    {
        $this->offsetSet($coordinate, $data);
    }

    ///////////GraphInterface implementation///////////
    public function isAdjacent($coordinate1, $coordinate2)
    {
        return (
    }
    
    public function getNeighbors($coordinate)
    {
        return $this->getNode($coordinate)->getNeighbors();
    }
    
    public function getNode($coordinate)
    {
        return $this->offsetGet($coordinate);
    }
    
    public function setNode($coordinate, $data)
    {
        $this->offsetSet($coordinate, $data);
    }

    //Cannot manually connect or disconnect in a fixed grid.
    public function connect($node1, $node2)
    {
        throw new BadMethodCallException("Cannot modify edges in a fixed graph");
    }

    public function disconnect($node1, $node2)
    {
        throw new BadMethodCallException("Cannot modify edges in a fixed graph");
    }

    //Weight information is controlled by the children of this class.
    abstract public function getWeight(Cell $cell1, Cell $cell2);
    abstract public function setWeight(Cell $cell1, Cell $cell2, $weight);

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
        if (in_array('Coordinate', class_uses($coords)) {
            $this->coordinates = $coords;
        } else {
            throw new InvalidArgumentException("The argument object must have the Coordinate trait.");
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