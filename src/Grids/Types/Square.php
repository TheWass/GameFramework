<?php
/**
 * @file Square.php
 * @author The Wass
 * @brief This file defines square grid
 *
 * @version 1.0 - 2015-03-18
 * * Initial Version
 * @version 1.1 - 2015-03-24
 * * Updated to function with the parent class.
 */
namespace TheWass\GameFramework\Grids\Types;
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
        parent::__construct($size, $size);
    }
}
