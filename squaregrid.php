<?php
class SquareGrid extends Grid
{
    public function __construct($size)
    {
        parent::__construct('SquareCell');
    }
    public function getWeight(SquareCoordinate $coord1, SquareCoordinate $coord2)
    {

    }

    public function setWeight(SquareCoordinate $coord1, SquareCoordinate $coord2, $weight)
    {

    }
}

class SquareCell extends Cell
{
    public $face
    public $sEdge
    public $wEdge
    public $vertex
}

class SquareCoordinate extends Coordinate
{
    protected $x;
    protected $y;

    public function calculateNeighbors()
    {
        return array(
            new SquareCoordinate($this->x + 1, $this->y),
            new SquareCoordinate($this->x, $this->y + 1),
            new SquareCoordinate($this->x - 1, $this->y),
            new SquareCoordinate($this->x, $this->y - 1)
        );
    }
}