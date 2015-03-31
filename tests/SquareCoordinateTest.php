<?php
/**
 * @file SquareCoordinateTest.php
 * @author The Wass
 * @brief This file tests the Square Coordinate system
 *
 * @version 1.0 - 2015-03-31
 * * Initial version
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
    public function setUp()
    {
        $this->coordinate   = new Square(0, 0);

        $this->neighbor = new Square(0, 1);
        $this->notNeighbor = new Square(1, 1);
        $this->neighbors = array(
            new Square(1, 0),
            new Square(0, 1),
            new Square(-1, 0),
            new Square(0, -1)
        );
        $this->components = array('x', 'y');
        $this->stringRep = '(0, 0)';
    }
}