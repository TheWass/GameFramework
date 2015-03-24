<?php
/**
 * @file SquareCoordinateTest.php
 * @author The Wass
 * @brief This file tests the Square Coordinate system
 *
 * @version 1.0 - 2015-03-24
 * * Initial version
 */
namespace TheWass\GameFramework\Tests;

use TheWass\GameFramework\Grids\Coordinates\Square;
use TheWass\GameFramework\Grids\Coordinates\Axial;
/**
 * @class SquareCoordinateTest
 * @author The Wass
 * @brief Collection of tests for the Square Coordinate System
 */
class SquareCoordinateTest extends PHPUnit_Framework_TestCase
{
    protected $origin;
    protected $positive;
    protected $negative;
    protected $neighbor;
    protected $axial;
    
    public function setUp()
    {
        $this->origin   = new Square(0, 0);
        $this->positive = new Square(1, 1);
        $this->negative = new Square(-1, -1);
        $this->neighbor = new Square(1, 0);
        $this->axial    = new Axial(0, 0);
    }
    
    public function testOriginNeighbors()
    {
        $expectedNeighbors = array(
            new Square(1, 0),
            new Square(0, 1),
            new Square(-1, 0),
            new Square(0, -1)
        );
    }
}