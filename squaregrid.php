<?php
class SquareGrid implements Grid
{
    private $gridData = new SplObjectStorage();

    public function setCell(Coordinate2D $coord, Cell $data)
    {
        $this->gridData[$coord] = $data;
    }

    public function getCell(Coordinate2D $coord)
    {
        return $this->gridData[$coord];
    }

    public function __invoke(Coordinate2D $coord)
    {
        return $this->getCell($coord);
    }

    public function __isset(Coordinate2D $coord)
    {

    }

    public function __unset(Coordinate2D $coord)
    {

    }

    public function isAdjacent(Coordinate2D $coord1, Coordinate2D $coord2)
    {

    }

    public function getWeight(Coordinate2D $coord1, Coordinate2D $coord2)
    {

    }

    public function setWeight(Coordinate2D $coord1, Coordinate2D $coord2)
    {

    }
}

class SquareCell extends Cell
{
    public $face
    public $sEdge
    public $wEdge
    public $vertex

    public getNeighbors()
    {
        $x = $this->coordinates->x;
        $y = $this->coordinates->y;
        return array(
            new Coordinate2D($x + 1, $y),
            new Coordinate2D($x, $y + 1),
            new Coordinate2D($x - 1, $y),
            new Coordinate2D($x, $y - 1)
        );
    }
}

class Coordinate2D
{
    use Coordinate;
    private $x;
    private $y;
}