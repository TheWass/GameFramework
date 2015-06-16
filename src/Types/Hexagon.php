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
namespace TheWass\Grid\Types;

use TheWass\Grid\Coordinates\Axial;
/**
 * @class Hexagon
 * @author The Wass
 * @brief hexagonal grid with hex cells.
 * @description description
 */
class Hexagon extends BaseGrid
{
    private $radius;

    /**
     * @brief Creates a Hexagonal grid
     * @param $radius - Maximum radius - 0 is infinite
     */
    public function __construct($radius = 0)
    {
        parent::__construct('Axial');
    }

    public function isInGridRange(Axial $coordinate)
    {
        return ($this->radius <= 0 && ($coordinate->x <= $this->radius && $coordinate->y <= $this->radius));
    }
}
