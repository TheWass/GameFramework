<?php
class SquareGrid implements Grid
{
    private $gridData = new SplObjectStorage();

    public function setCell(Coordinate $coord, Cell $data)
    {
        $this->gridData[$coord] = $data;
    }

    public function getCell(Coordinate $coord)
    {

        return $this->gridData[$coord];
    }

    public function __invoke(Coordinate $coord)
    {
        return $this->getCell($coord);
    }

    public function __isset(Coordinate $coord)
    {

    }

    public function __unset(Coordinate $coord)
    {

    }

    public function isAdjacent(Coordinate $coord1, Coordinate $coord2)
    {

    }

    public function getWeight(Coordinate $coord1, Coordinate $coord2)
    {

    }

    public function setWeight(Coordinate $coord1, Coordinate $coord2)
    {

    }
}

class SquareCell extends Cell
{
    protected $face
    protected $sEdge
    protected $wEdge
    protected $vertex

    public getNeighbors()
    {
        $x = $coordinates->x;
        $y = $coordinates->y;
        return array(
            new Coordinate($x + 1, $y),
            new Coordinate($x, $y + 1),
            new Coordinate($x - 1, $y),
            new Coordinate($x, $y - 1)
        );
    }
}

class Coordinate2D
{
    use Coordinate;
    private $x;
    private $y;
}