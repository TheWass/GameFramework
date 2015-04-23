<?php
/**
 * @file CoordinateTest.php
 * @author The Wass
 * @brief This file tests the Coordinate system
 *
 * @version 1.0 - 2015-03-24
 * * Initial version
 * @version 1.1 - 2015-03-30
 * * Added Origin tests
 * * Abstracted the class.
 * @version 2.0 - 2015-04-03
 * * Removed Neighbors: They will be controlled by the Grid, and stored in the Cell.
 * @version 2.1 - 2015-04-13
 * * Added verifying neighbor calculations.
 * * Added Invalid Constructor tests.
 */
namespace TheWass\GameFramework\Tests;
/**
 * @class CoordinateTest
 * @author The Wass
 * @brief Collection of tests for the Coordinate System
 * @description  A coordinate must have the following attributes:
 * * Unable to mutate self
 * * Able to get components
 * * Able to calculate neighbors
 */
abstract class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    //Expected values
    protected $components;  ///< An array of component names

    /**
     * @brief Initialize *all* protected attributes of this class in the setup function.
     */
    public function setUp(){}

    /**
     * @brief Provide coordinate objects for testing.
     * @return array of arrays of coordinate objects
     */
    abstract public function coordinateProvider();

    /**
     * @brief Provide expected neighbor calculations for testing.
     * @return array of neighbors for the coordinate.
     */
    abstract public function getExpectedNeighbors($coordinate);

    /**
     * @brief Test the constructor for an invalid coordinate value
     * @expectedException InvalidArgumentException
     */
    abstract public function testConstructorBadValues();

    /**
     * @brief Test the output string looks like a coordinate.
     * @dataProvider coordinateProvider
     */
    public function testString($coordinate)
    {
        $this->expectOutputRegex('/^\(-?.+(?:, -?.+)*\)$/');
        print $coordinate;
    }

    /**
     * @brief Test getting components of the coordinate.
     * @dataProvider coordinateProvider
     */
    public function testGetComponents($coordinate)
    {
        foreach ($this->components as $component) {
            $this->assertNotNull($coordinate->{$component});
        }
    }

    /**
     * @brief Test correct calculation of the neighbors
     * @dataProvider coordinateProvider
     */
    public function testCalculateNeighbors($coordinate)
    {
        $expectedNeighbors = $this->getExpectedNeighbors($coordinate);
        $neighbors = $coordinate->calculateNeighbors();
        //array_diff checks the string representation of the coordinate.
        $this->assertEmpty(array_diff($expectedNeighbors, $neighbors));
    }

    /**
     * @brief Test setting the first component
     * @expectedException BadMethodCallException
     * @dataProvider coordinateProvider
     */
    public function testSetComponent($coordinate)
    {
        $coordinate->{$this->components[0]} = 4;
    }

    /**
     * @brief Test adding a new property
     * @expectedException BadMethodCallException
     * @dataProvider coordinateProvider
     */
    public function testSelfMutate($coordinate)
    {
        $coordinate->newProperty = 'bob';
    }

    /**
     * @brief Test getting an invalid property
     * @expectedException BadMethodCallException
     * @dataProvider coordinateProvider
     */
    public function testBadGet($coordinate)
    {
        $var = $coordinate->newProperty;
    }
}