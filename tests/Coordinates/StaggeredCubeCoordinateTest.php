<?php
/**
 * @file StaggeredCubeCoordinateTest.php
 * @author The Wass
 * @brief This file tests the StaggeredCube Coordinate system
 *
 * @version 1.0 - 2015-05-07
 * * Initial version
 */
namespace TheWass\Grid\Tests\Coordinates;

use TheWass\Grid\Coordinates\StaggeredCube;
/**
 * @class StaggeredCubeCoordinateTest
 * @author The Wass
 * @brief Collection of tests for the StaggeredCube Coordinate System
 * @description  This class determines what separates a StaggeredCube coordinate from any other.
 */
class StaggeredCubeCoordinateTest extends \PHPUnit_Framework_TestCase implements CoordinateTestInterface
{
    private $testCoord;
    public function setUp()
    {
        $this->testCoord = new StaggeredCube(0, 0, 0);
    }
    
    /**
     * @brief Test correct calculation of the neighbors
     */
    public function testCalculateNeighbors()
    {
        $expectedNeighbors = array(
            new StaggeredCube(-1, -1, -1),
            new StaggeredCube(0, -1, -1),
            new StaggeredCube(-1, 0, -1),
            new StaggeredCube(0, 0, -1),
            new StaggeredCube(-1, 0, 0),
            new StaggeredCube(0, -1, 0),
            new StaggeredCube(0, 1, 0),
            new StaggeredCube(1, 0, 0),
            new StaggeredCube(0, 0, 1),
            new StaggeredCube(1, 0, 1),
            new StaggeredCube(0, 1, 1),
            new StaggeredCube(1, 1, 1)
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
            array(1, 2),
            array(1, 2, 3, 4),
            array('bob', 'joe', 'billy')
        );
    }

    /**
     * @brief Test the constructor for an invalid coordinate value
     * @expectedException InvalidArgumentException
     * @dataProvider badConstructorValues
     */
    public function testConstructorBadValues()
    {
        $rc = new \ReflectionClass('TheWass\Grid\Coordinates\StaggeredCube');
        $inst = $rc->newInstanceArgs(func_get_args());
    }
}