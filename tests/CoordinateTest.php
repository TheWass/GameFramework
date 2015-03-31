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
 */
namespace TheWass\GameFramework\Tests;
/**
 * @class CoordinateTest
 * @author The Wass
 * @brief Collection of tests for the Coordinate System
 * @description  A coordinate must have the following attributes:
 * * Unable to mutate self
 * * Able to get components
 * * Have some list of neighboring coordinates that are of the same class
 * * Unable to mutate the list of neighbors
 * * Able to set and get weights to neighbors
 * * Unable to set or get weights to non-neighbors
 */
abstract class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    //Test object
    protected $coordinate;  ///< The coordinate to test

    //Expected values
    protected $neighbor;    ///< A valid neighboring coordinate
    protected $notNeighbor; ///< A valid non-neighboring coordinate
    protected $neighbors;   ///< An array of neighboring coordinates
    protected $components;  ///< An array of component names
    protected $stringRep;   ///< A string representation of the coordinate

    /**
     * @brief Initialize *all* protected attributes of this class in the setup function.
     */
    public function setUp()
    {
        
    }

    public function testGetComponents()
    {
        $values = array();
        foreach ($this->components as $component) {
            $this->assertNotNull($this->coordinate->{$component});
            $values[] = $this->coordinate->{$component};
        }
        $string = '(' . implode(', ', $values) . ')';
        $this->assertEquals($string, $this->stringRep);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetComponent()
    {
        $this->coordinate->{$this->components[0]} = 4;
    }

    public function testOriginNeighbors()
    {
        $this->assertEmpty(array_diff($this->coordinate->getNeighbors(), $this->neighbors));
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testNeighborListMutation()
    {
        $this->coordinate->neighbors = 4;
    }

    public function testWeights()
    {
        $this->assertEquals($this->coordinate->setWeight($this->neighbor, 4), 4);
        $this->assertEquals($this->coordinate->getWeight($this->neighbor), 4);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetWeightException()
    {
        $this->coordinate->setWeight($this->notNeighbor, 4);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetWeightException()
    {
        $this->coordinate->getWeight($this->notNeighbor);
    }
}