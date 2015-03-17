<?php
namespace TheWass\GameFramework\Grids\SquareGrid;

class SquareGrid extends Grid
{
    public function __construct($size)
    {
        parent::__construct('FourSidedCell');
    }

    public function getWeight(SquareCell $cell1, SquareCell $cell2)
    {
        
    }

    public function setWeight(SquareCell $cell1, SquareCell $cell2, $weight)
    {
        
    }
}
