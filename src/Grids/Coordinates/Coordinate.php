<?php
/**
 * @file Coordinate.php
 * @author The Wass
 * @brief This file defines a template for a coordinate system of any dimension
 *
 * @version 1.0 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 *
 * @version 2.0 - 2015-03-23
 * * Migrated neighbors to this class, pulling it out of the Cell's responsibility.
 * * Added get and set weights
 * * Added functionality for children to restrict coordinate values using the validate function.
 * @version 2.1 - 2015-03-31
 * * Protected calculate neighbors.  getNeighbors should be used to get the neighbors.
 */
namespace TheWass\GameFramework\Grids\Coordinates;
/**
 * @class Coordinate
 * @author The Wass
 * @brief Abstract class to facilitate constructing a coordinate system.
 * @description The coordinate system, particularly the calculateNeighbors function
 * largely determines what the grid looks like.
 */
abstract class Coordinate
{
    private $neighbors;     //Storage object to hold the neighbors and associated weights

    public function __construct()
    {
        //Get list of property names of the child only
        $properties = array_keys(array_diff_key(get_class_vars(get_class($this)),
                                                get_class_vars(get_class())));
        //combine arrays so $property => $value
        if (($toAssign = array_combine($properties, func_get_args()))) {
            //Set properties
            foreach ($toAssign as $prop=>$val) {
                if ($this->validate($prop, $val)) {
                    $this->$prop = $val;
                } else {
                    throw new \InvalidArgumentException("$val is not valid for $prop");
                }
            }
        } else {
            throw new \InvalidArgumentException("Invalid number of arguments passed.  Need ". count($properties));
        }
    }

    public function __get($name)
    {
        if ($name == 'neighbors') {
            return $this->getNeighbors();
        } else if (property_exists(get_class($this), $name)) {
            return $this->$name;
        } else {
            throw new \BadMethodCallException("$name is not a valid property.");
        }
    }
    
    //Prevent attribute mutation
    final public function __set($name, $value)
    {
        throw new \BadMethodCallException("Cannot set $name");
    }

    public function __toString()
    {
        return '(' . implode(', ', $this->toArray()) . ')';
    }

    public function toArray()
    {
        return array_diff_key(get_class_vars(get_class($this)),
                              get_class_vars(get_class()));
    }
    
    private function initializeNeighbors()
    {
        $this->neighbors = new \SplObjectStorage();
        $neighbors = $this->calculateNeighbors();
        foreach ($neighbors as $neighbor) {
            $this->neighbors[$neighbor] = 1;
        }
    }

    public function getNeighbors()
    {
        if (!isset($this->neighbors)) {
            $this->initializeNeighbors();
        }

        $neighbors = array();
        foreach ($this->neighbors as $coord) {
            $neighbors[] = $coord;
        }
        return $neighbors;
    }

    public function getWeight(Coordinate $dest)
    {
        if (!isset($this->neighbors)) {
            $this->initializeNeighbors();
        }
        var_dump($this->neighbors);
        if ($this->neighbors->contains($dest)) {
            return $this->neighbors[$dest];
        } else {
            throw new \InvalidArgumentException("$dest is not a neighbor of $this");
            return false;
        }
    }

    public function setWeight(Coordinate $dest, $weight)
    {
        if (!isset($this->neighbors)) {
            $this->initializeNeighbors();
        }
        if ($this->neighbors->contains($dest)) {
            $this->neighbors[$dest] = $weight;
            return $weight;
        } else {
            throw new \InvalidArgumentException("$dest is not a neighbor of $this");
            return false;
        }
    }

    /**
     * @brief Validates the value for the property. Intended on being overwritten.
     * @param $property - Property to be tested
     * @param $value    - Value to be tested
     * @return Boolean
     */
    public function validate($property, $value)
    {
        return is_int($value);
    }

    /**
     * @brief Calculates the coordinates of neighboring cells.
     * @return An array of coordinate objects.
     */
    abstract protected function calculateNeighbors();

}
