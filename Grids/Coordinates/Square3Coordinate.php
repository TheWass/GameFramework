<?php
/**
 * @file Square3Coordinate.php
 * @author The Wass
 * @brief This file defines a coordinate system which creates a 3 person chess style grid
 * @description I'm not really sure what to call this file, The coordinate system is inspired
 * by a 3-man chess grid.
 *
 * @version 1.0.0 - 2015-03-13
 * * Initial version
 */
namespace Wasser\GameFramework\Grids\Coordinates;
/**
 * @class Square3Coordinate
 * @author The Wass
 * @brief Class which tesselates into a hexagon shaped grid with 4-sided cells.
 * @description description
 */
class Square3Coordinate extends Coordinate
{
    protected $sub
    protected $x;
    protected $y;

    
    public function calculateNeighbors()
    {
        /*
        Magic here
        */
        return array();
    }
}