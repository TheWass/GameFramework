<?php
/**
 * @file SquareGridTest.php
 * @author The Wass
 * @brief This file tests the Square Coordinate system
 *
 * @version 1.0 - 2015-04-23
 * * Initial version
 */
namespace TheWass\Grid\Tests;

use TheWass\Grid\Square;
/**
 * @class SquareGridTest
 * @author The Wass
 * @brief Collection of tests for the Square Grid System
 * @description  This class determines what separates a Square Grid from any other.
 */
class SquareGridTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @brief Initialize *all* protected attributes of this class in the setup function.
     */
    public function setUp()
    {
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
    
    public function testIncomplete()
    {
        //make phpunit happy
       $this->assertTrue(true);
    }

}