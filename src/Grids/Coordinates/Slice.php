<?php
/**
 * @file Slice.php
 * @author The Wass
 * @brief This file defines a coordinate system which creates an irregular grid which is divided into slices.
 * @description Each of the slices within the grid consists of a sub square grid
 * This grid is inspired by three-man chess.
 *
 * @todo Make this a recursive grid type that can take any sub grid (perhaps even itself)
 *
 * @version 1.0 - 2015-03-13
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

    public function validate($property, $value)
    {
        if (strtolower($property) == 'slice' or strtolower($property) == 'y') {
            return (is_int($value) and $value >= 0);
        } else {
            return is_int($value);
        }
    }

    public function calculateNeighbors()
    {
        /*
        Magic here
        */
        return array();
    }
}
