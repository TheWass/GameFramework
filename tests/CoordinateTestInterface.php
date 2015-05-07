<?php
/**
 * @file CoordinateTestInterface.php
 * @author The Wass
 * @brief This file defines tests for concrete Coordinate systems
 *
 * @version 1.0 - 2015-05-07
 * * Initial version
 */
namespace TheWass\Grid\Tests;
/**
 * @class CoordinateTestInterface
 * @author The Wass
 * @brief Collection of recommended tests for concrete Coordinate Systems
 * @description  A coordinate must have the following attributes:
 * * Unable to mutate self
 * * Able to get components
 * * Able to calculate neighbors
 */
interface CoordinateTestInterface
{
    /**
     * @brief Test correct calculation of the neighbors
     */
    public function testCalculateNeighbors();

    /**
     * @brief Test getting components of the coordinate.
     */
    public function testGetComponents();

    /**
     * @brief Test setting the components
     * @expectedException BadMethodCallException
     */
    public function testSetComponentFail();

    /**
     * @brief Test the constructor for an invalid coordinate value
     * @expectedException InvalidArgumentException
     */
    public function testConstructorBadValues();

}