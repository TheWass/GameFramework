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
 * @version 3.0 - 2015-05-07
 * * Changed structure, added an interface to comply to.
 */
namespace TheWass\Grid\Tests\Coordinates;

use TheWass\Grid\Coordinates\Square;
/**
 * @class SquareCoordinateTest
 * @author The Wass
 * @brief Collection of tests for the Square Coordinate System
 * @description  This class determines what separates a Square coordinate from any other.
 */
class SquareCoordinateTest extends \PHPUnit_Framework_TestCase implements CoordinateTestInterface
{
    private $testCoord;
    public function setUp()
    {
        $this->testCoord = new Square(0, 0);
    }
    
    /**
     * @brief Test correct calculation of the neighbors
     */
    public function testCalculateNeighbors()
    {
        $expectedNeighbors = array(
            new Square(1, 0),
            new Square(0, 1),
            new Square(-1, 0),
            new Square(0, -1)
        );
        $neighbors = $this->testCoord->calculateNeighbors();
        $this->assertEmpty(array_diff($expectedNeighbors, $neighbors));
    }

    /**
     * @brief Test getting components of the coordinate.
     */
    public function testGetComponents()
    {
        $this->assertEquals(0, $this->testCoord->x);
    }

    /**
     * @brief Test setting the components
     * @expectedException BadMethodCallException
     */
    public function testSetComponentFail()
    {
        $this->testCoord->x = 1;
    }
    
    public function badConstructorValues()
    {
        return array(
            array(1),
            array(1, 2, 3),
            array('bob', 'joe')
        );
    }

    /**
     * @brief Test the constructor for an invalid coordinate value
     * @expectedException InvalidArgumentException
     * @dataProvider badConstructorValues
     */
    public function testConstructorBadValues()
    {
        $rc = new \ReflectionClass('TheWass\Grid\Coordinates\Square');
        $inst = $rc->newInstanceArgs(func_get_args());
    }
}