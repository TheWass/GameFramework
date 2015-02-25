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

    private __construct(Coordinate $coords)
    {
        $this->coordinates = $coords;
    }

    public function getNeighbors();
}

trait Coordinate
{
    public function __construct()
    {
        //Get list of property names
        $properties = array_keys(get_class_vars(__CLASS__));
        //throw error if number of properties and number of arguments does not match
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

    public function __toString()
    {
        return '(' . implode(', ', get_object_vars($this)) . ')';
    }
}