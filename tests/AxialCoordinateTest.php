<?php
/**
 * @file AxialCoordinateTest.php
 * @author The Wass
 * @brief This file tests the Axial Coordinate system
 *
 * @version 1.0 - 2015-05-07
 * * Initial version
 */
namespace TheWass\Grid\Tests;

use TheWass\Grid\Coordinates\Axial;
use TheWass\Grid\Coordinates\HexCube;
/**
 * @class AxialCoordinateTest
 * @author The Wass
 * @brief Collection of tests for the Axial Coordinate System
 * @description  This class determines what separates an Axial coordinate from any other.
 */
class AxialCoordinateTest extends \PHPUnit_Framework_TestCase implements CoordinateTestInterface
{
    private $testCoord;
    public function setUp()
    {
        $this->testCoord = new Axial(0, 0);
    }

    /**
     * @brief Test correct calculation of the neighbors
     */
    public function testCalculateNeighbors()
    {
        $expectedNeighbors = array(
            new Axial(1, 0),
            new Axial(0, 1),
            new Axial(-1, 0),
            new Axial(0, -1),
            new Axial(1, -1),
            new Axial(-1, 1)
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
        $rc = new \ReflectionClass('TheWass\Grid\Coordinates\Axial');
        $inst = $rc->newInstanceArgs(func_get_args());
    }

    /**
     * @brief Test converting to a HexCube coordinate
     */
    public function testConvertToHexCube()
    {
        $hexCube = new HexCube(0, 0, 0);
        $this->assertEquals($hexCube, $this->testCoord->toHexCube());
    }
}