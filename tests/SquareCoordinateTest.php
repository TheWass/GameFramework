<?php
/**
 * @file SquareCoordinateTest.php
 * @author The Wass
 * @brief This file tests the Square Coordinate system
 *
 * @version 1.0 - 2015-03-31
 * * Initial version
 * @version 2.0 - 2015-04-03
 * * Removed neighbors
 */
namespace TheWass\GameFramework\Tests;

use TheWass\GameFramework\Grids\Coordinates\Square;
/**
 * @class SquareCoordinateTest
 * @author The Wass
 * @brief Collection of tests for the Square Coordinate System
 */
class SquareCoordinateTest extends CoordinateTest
{
    /**
     * @brief Initialize *all* protected attributes of this class in the setup function.
     */
    public function setUp()
    {
        $this->components = array('x', 'y');
    }

    /**
     * @brief Provide coordinate objects for testing.
     * @return array of arrays of coordinate objects
     */
    public function coordinateProvider()
    {
        return array (
            array(new Square(1, 1)),
            array(new Square(0, 1)),
            array(new Square(1, 0)),
            array(new Square(0, -1)),
            array(new Square(-1, 0)),
            array(new Square(-1, -1))
        );
    }
    
    /**
     * @brief Test correct calculation of the neighbors
     * @dataProvider coordinateProvider
     */
    public function testCalculateNeighbors($coordinate)
    {
        $expectedNeighbors = array(
            new Square($coordinate->x, $coordinate->y),
            new Square($coordinate->x, $coordinate->y),
            new Square($coordinate->x, $coordinate->y),
            new Square($coordinate->x, $coordinate->y)
        );
        $neighbors = $coordinate->calculateNeighbors();
        //Incomplete
    }
}