<?php
interface Grid
{
    public function setCell($cell, $data);
    public function getCell($cell);

    public function isAdjacent($cell1, $cell2);
    public function getWeight($cell1, $cell2);
    public function setWeight($cell1, $cell2);

}

abstract class Cell
{
    private $coordinates;

    public __construct($coords)
    {
        if (in_array('Coordinate', class_uses($coords))){
            $this->coordinates = $coords;
        } else {
            throw new InvalidArgumentException("The argument must have the Coordinate trait.");
        }
    }

    protected function getCoordinates()
    {
        return $this->coordinates;
    }

    abstract public function getNeighbors();
}

trait Coordinate
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
}