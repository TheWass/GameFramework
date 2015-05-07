<?php
/**
 * @file HexCubeCoordinateTest.php
 * @author The Wass
 * @brief This file tests the HexCube Coordinate system
 *
 * @version 1.0 - 2015-05-07
 * * Initial version
 */
namespace TheWass\Grid\Tests;

use TheWass\Grid\Coordinates\Axial;
use TheWass\Grid\Coordinates\HexCube;
/**
 * @class HexCubeCoordinateTest
 * @author The Wass
 * @brief Collection of tests for the HexCube Coordinate System
 * @description  This class determines what separates a HexCube coordinate from any other.
 */
class HexCubeCoordinateTest extends \PHPUnit_Framework_TestCase implements CoordinateTestInterface
{
    private $testCoord;
    public function setUp()
    {
        $this->testCoord = new HexCube(0, 0, 0);
    }

    /**
     * @brief Test correct calculation of the neighbors
     */
    public function testCalculateNeighbors()
    {
        $expectedNeighbors = array(
            new HexCube(1, 0, -1),
            new HexCube(0, 1, -1),
            new HexCube(-1, 0, 1),
            new HexCube(0, -1, 1),
            new HexCube(1, -1, 0),
            new HexCube(-1, 1, 0)
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
            array(1, 2, 3),
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
        $rc = new \ReflectionClass('TheWass\Grid\Coordinates\HexCube');
        $inst = $rc->newInstanceArgs(func_get_args());
    }

    /**
     * @brief Test converting to an Axial coordinate
     */
    public function testConvertToHexCube()
    {
        $axial = new Axial(0, 0);
        $this->assertEquals($axial, $this->testCoord->toAxial());
    }
}