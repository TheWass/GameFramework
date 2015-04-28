<?php
/**
 * @file Slice.php
 * @author The Wass
 * @brief This file defines a grid sliced into sections
 * @description Each of the slices within the grid consists of a sub grid
 * This grid is inspired by three-man chess.
 *
 * @version 1.0 - 2015-03-24
 * * Initial Version
 */
namespace TheWass\Grid\Types;

use TheWass\Grid\Grid;
use TheWass\Grid\Coordinate;
/**
 * @class Slice
 * @author The Wass
 * @brief Slice grid with some number of sub grids
 * @description description
 */
class Slice implements Grid, ArrayAccess
{
    protected $grids;

    /**
     * @brief Creates a grid with many slices
     * @param $slices      - Number of slices in the grid
     * @param $subGridType - Desired Grid class name
     */
    public function __construct($slices, $subGridType)
    {
    }

    public function offsetExists(Coordinate $coordinate)
    {
    }

    public function offsetGet(Coordinate $coordinate)
    {
    }

    public function offsetUnset(Coordinate $coordinate)
    {
    }

    public function offsetSet(Coordinate $coordinate, $data)
    {
    }

    public function attach(Coordinate $coordinate, $data)
    {
        $this->offsetSet($coordinate, $data);
    }

    public function detach(Coordinate $coordinate)
    {
        $this->offsetUnset($coordinate);
    }

    ///////////Grid implementation///////////
    public function isAdjacent(Coordinate $source, Coordinate $destination)
    {
        return in_array($destination, $source->calculateNeighbors());
    }

    public function getNeighbors(Coordinate $coordinate)
    {
        return $coordinate->calculateNeighbors();
    }

    public function getCell(Coordinate $coordinate)
    {
        return $this->offsetGet($coordinate);
    }

    public function setCell(Coordinate $coordinate, $data)
    {
        $this->offsetSet($coordinate, $data);
    }

    public function getWeight(Cell $source, Coordinate $destination)
    {
        return $source->getWeight($destination);
    }

    public function setWeight(Cell $source, Coordinate $destination, $weight)
    {
        return $source->setWeight($destination, $weight);
    }
}