<?php
/**
 * @file SquareGridTest.php
 * @author The Wass
 * @brief This file tests the Square Coordinate system
 *
 * @version 1.0 - 2015-04-23
 * * Initial version
 */
namespace TheWass\Grid\Tests\Grids;

use TheWass\Grid\Types\Square as SquareGrid;
use TheWass\Grid\Coordinates\Square as SquareCoordinate;
/**
 * @class SquareGridTest
 * @author The Wass
 * @brief Collection of tests for the Square Grid System
 * @description  This class determines what separates a Square Grid from any other.
 */
class SquareGridTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @brief Test the boundary coordinates of the grid.
     */
    public function testRange()
    {
        $testGrid = new SquareGrid(5);
        $this->assertTrue($testGrid->isInGridRange(new SquareCoordinate(1, 1)));
        $this->assertTrue($testGrid->isInGridRange(new SquareCoordinate(-1, -1)));
        $this->assertTrue($testGrid->isInGridRange(new SquareCoordinate(5, 5)));
        $this->assertTrue($testGrid->isInGridRange(new SquareCoordinate(-5, -5)));
        $this->assertFalse($testGrid->isInGridRange(new SquareCoordinate(-6, -6)));
        $this->assertFalse($testGrid->isInGridRange(new SquareCoordinate(6, 6)));
        
    }
}
