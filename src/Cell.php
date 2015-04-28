<?php
/**
 * @file Cell.php
 * @author The Wass
 * @brief This file defines a standard, extensible Cell
 *
 * @version 1.0 - 2015-04-03
 * * Initial Version
 * @version 2.0 - 2015-04-28
 * * Added ArrayAccess.
 */
namespace TheWass\Grid;
/**
 * @class Cell
 * @author The Wass
 * @brief Data container object.
 * @description This container also handles storing and getting the neighboring weights.
 * The neighbors cannot be checked for validity.  That will be done in the grid.
 * The neighbors are only stored if the weight is not the default (1).
 * Weights cannot be 0 or negative.
 */
class Cell implements \ArrayAccess
{
    private $neighbors;
    private $data;

    public function __construct()
    {
        $this->neighbors = new \SplObjectStorage();
        $this->data = array();
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __get($name)
    {
        return $this->data[$name];
    }


    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    /**
     * @brief Sets the neighbor's weight
     * @param Coordinate $destination - Neighboring coordinate
     * @param integer $value - Weight, can only be positive.
     * @return void
     */
    public function setWeight(Coordinate $destination, $value)
    {
        assert('is_int($value)');
        if ($value < 0) {
            throw new \RangeException("$value must be positive.");
        } elseif ($value > 1) {
            $this->neighbors[$destination] = $value;
        } else {
            unset($this->neighbors[$destination]);
        }
    }

    /**
     * @brief Gets the neighbor's weight
     * @description  False does *NOT* mean that the $destination is not a neighbor
     * It just means that it does not have an attached weight.
     * The weight *could* be 1.
     * @param Coordinate $destination - Neighboring coordinate
     * @return integer|false - The set weight or false if not in the list.
     */
    public function getWeight(Coordinate $destination)
    {
        if ($this->neighbors->contains($destination)) {
            return $this->neighbors[$destination];
        } else {
            return false;
        }
    }

    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }

    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->__set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->__unset($offset);
    }
}
