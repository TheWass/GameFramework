<?php
namespace TheWass\GameFramework\Grids;

class HexGrid
{
    public function __construct($size)
    {
        parent::__construct('SquareCell');
    }

    public function getWeight(SquareCell $cell1, SquareCell $cell2)
    {
        
    }

    public function setWeight(SquareCell $cell1, SquareCell $cell2, $weight)
    {
        
    }
}

class SquareCell extends Cell
{
    public $face;
    public $sEdge;
    public $wEdge;
    public $vertex;
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
