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
 * @version 2.1 - 2015-04-13
 * * Added expected neighbors
 */
namespace TheWass\GameFramework\Tests;

use TheWass\GameFramework\Grids\Coordinates\Square;
/**
 * @class SquareCoordinateTest
 * @author The Wass
 * @brief Collection of tests for the Square Coordinate System
 * @description  This class determines what separates a Square coordinate from any other.
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
     * @return array of arrays. Each containing a coordinate object.
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
     * @brief Provide expected neighbor calculations for testing.
     * @return array of neighbors for the coordinate.
     */
    public function getExpectedNeighbors($coordinate)
    {
        return array(
            new Square($coordinate->x + 1, $coordinate->y),
            new Square($coordinate->x, $coordinate->y + 1),
            new Square($coordinate->x - 1, $coordinate->y),
            new Square($coordinate->x, $coordinate->y - 1)
        );
    }

    /**
     * @brief Test the constructor for an invalid coordinate value
     * @expectedException InvalidArgumentException
     */
    public function testConstructorBadValues()
    {
        $inst = new Square('billy', 'bob');
    }
}