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
    private $neighbors; //Storage object to hold the neighbors and associated weights

    public function __construct()
    {
        //Get list of property names
        $properties = array_keys(get_class_vars(get_class($this)));
        //combine arrays so $property => $value
        if (($toAssign = array_combine($properties, func_get_arg($i)))) {
            //Set properties
            foreach ($toAssign as $prop=>$val) {
                if ($this->validate($prop, $val)) {
                    $this->$prop = $val;
                } else {
                    throw new InvalidArgumentException("$val is not valid for $prop");
                }
            }
        } else {
            throw new InvalidArgumentException("Invalid number of arguments passed.  Need ". count($properties));
        }
        //set neighbors and initial weights
        $this->neighbors = new SplObjectStorage();
        $neighbors = $this->calculateNeighbors();
        foreach ($neighbors as $neighbor) {
            $this->neighbors[$neighbor] = 1;
        }
    }

    public function __get($name)
    {
        if (in_array($name, array_keys(get_class_vars(get_class($this))))) {
            return $this->$name;
        } else {
            throw new BadMethodCallException("$name is not a valid property.");
        }
    }

    public function __toString()
    {
        return '(' . implode(', ', $this->toArray()) . ')';
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function getNeighbors()
    {
        $neighbors = array();
        foreach ($this->neighbors as $coord) {
            $neighbors[] = $coord;
        }
        return $neighbors;
    }

    public getWeight(Coordinate $dest)
    {
        if $this->neighbors->contains($dest) {
            return $this->neighbors[$dest];
        } else {
            return false;
        }
    }

    public setWeight(Coordinate $dest, $weight)
    {
        if $this->neighbors->contains($dest) {
            $this->neighbors[$dest] = $weight
            return $weight;
        } else {
            return false;
        }
    }

    /**
     * @brief Calculates the coordinates of neighboring cells.
     * @return An array of coordinate objects.
     */
    abstract public function calculateNeighbors();

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
}
