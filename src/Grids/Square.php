<?php
/**
 * @file Square.php
 * @author The Wass
 * @brief This file defines square grid
 *
 * @version 1.0 - 2015-03-18
 * * Initial Version
 */
namespace TheWass\GameFramework\Grids;
/**
 * @class Square
 * @author The Wass
 * @brief Square grid with square cells.
 * @description description
 */
class Square extends Rectangle
{
    public function __construct($size = 0)
    {
        $this->height = $size;
        $this->width = $size;
        parent::__construct('Square');
    }
}
