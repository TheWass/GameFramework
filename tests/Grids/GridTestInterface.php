<?php
/**
 * @file GridTestInterface.php
 * @author The Wass
 * @brief This file provides a test list for concrete grids
 *
 * @version 1.0 - 2015-05-07
 * * Initial version
 */
namespace TheWass\Grid\Tests\Grids;
/**
 * @class GridTestInterface
 * @author The Wass
 * @brief Collection of recommended tests for a concrete grid system
 * @description
 */
interface GridTestInterface
{
    /**
     * @brief Test the boundary coordinates of the grid.
     */
    public function testRange();
}