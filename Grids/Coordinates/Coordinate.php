<?php
/**
 * @file Coordinate.php
 * @author The Wass
 * @brief This file defines a template for a coordinate system of any dimension
 *
 * @version 1.0.0 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 */
namespace Wasser\GameFramework\Grids\Coordinates;
/**
 * @class Coordinate
 * @author The Wass
 * @brief Abstract class to facilitate constructing a coordinate system.
 * @description The coordinate system, particularly the calculateNeighbors function
 * largely determines what the grid looks like.
 */
abstract class Coordinate
{
    public function __construct()
    {
        //Get list of property names
        $properties = array_keys(get_class_vars(get_class($this)));
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
        if (in_array($name, array_keys(get_class_vars(get_class($this))))) {
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

    /**
     * @brief Calculates the coordinates of neighboring cells.
     * @return An array of coordinate objects.
     */
    abstract public function calculateNeighbors();
}
