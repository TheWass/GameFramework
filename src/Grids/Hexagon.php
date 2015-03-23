<?php
/**
 * @file Hexagon.php
 * @author The Wass
 * @brief This file defines a hex grid
 *
 * @version 1.0 - 2015-03-18
 * * Initial Version
 *
 * @version 1.1 - 2015-03-23
 * * Modified Class to match the changes to abstract Grid.
 */
namespace TheWass\GameFramework\Grids;
/**
 * @class Hexagon
 * @author The Wass
 * @brief hexagonal grid with hex cells.
 * @description description
 */
class Hexagon extends Grid
{
    private $radius;

    /**
     * @brief Creates a Hexagonal grid
     * @param $radius - Maximum radius - 0 is infinite
     * @return hexagon grid object
     */
    public function __construct($radius = 0)
    {
        parent::__construct('Axial');
    }

    public function offsetSet(Coordinates\Axial $coordinate, $data)
    {
        if ($radius > 0 and ($coordinate->x > $radius or $coordinate->y > $radius)) {
            throw new RangeException("Coordinate is outside of the grid.");
        }
        parent::offsetSet($coordinate, $data);
    }

    public function attach(Coordinates\Axial $coordinate, $data)
    {
        $this->offsetSet($coordinate, $data);
    }
}
