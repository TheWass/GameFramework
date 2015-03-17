<?php
/**
 * @file Slice.php
 * @author The Wass
 * @brief This file defines a coordinate system which creates an irregular grid which is divided into slices.
 * @description Each of the slices within the regular grid consists of a rectangular grid of four-sided cells
 * This grid is inspired by three-man chess.
 *
 * @version 1.0.0 - 2015-03-13
 * * Initial version
 */
namespace Wasser\GameFramework\Grids\Coordinates;
/**
 * @class Slice
 * @author The Wass
 * @brief brief
 * @description description
 */
class Slice extends Coordinate
{
    protected $slice
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
