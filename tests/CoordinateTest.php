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
 * @version 3.0 - 2015-05-07
 * * Made Concrete to avoid testing multiple times.
 * * Moved functions which rely on the attributes out of this test.
 */
namespace TheWass\Grid\Tests;
/**
 * @class CoordinateTest
 * @author The Wass
 * @brief Collection of tests for the Coordinate System
 * @description  A coordinate must have the following attributes:
 * * Unable to mutate self
 * * Able to get components
 * * Able to calculate neighbors
 */
class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    private $coordinate;
    const OUTPUT_REGEX = '/^\(-?.+(?:, -?.+)*\)$/';

    /**
     * @brief Initialize *all* protected attributes of this class in the setup function.
     */
    public function setUp()
    {
        $this->coordinate = $this->getMockBuilder('TheWass\Grid\Coordinate')
                                 ->setMockClassName('TestCoordinate')
                                 ->disableOriginalConstructor()
                                 ->getMockForAbstractClass();
        $this->coordinate->method('calculateNeighbors')
                         ->will($this->returnValue(array($this->coordinate)));
    }

    /**
     * @brief Test the output string looks like a coordinate.
     */
    public function testString()
    {
        $this->assertEquals('()', $this->coordinate->__toString());
    }

    /**
     * @brief Test adding a new property
     * @expectedException BadMethodCallException
     */
    public function testSelfMutateFail()
    {
        $this->coordinate->newProperty = 'bob';
    }

    /**
     * @brief Test getting an invalid property
     * @expectedException BadMethodCallException
     */
    public function testGetFail()
    {
        $var = $this->coordinate->newProperty;
    }
}