<?php
/**
 * @file GridTest.php
 * @author The Wass
 * @brief This file tests the Grid class
 *
 * @version 1.0 - 2015-04-14
 * * Initial version
 */
namespace TheWass\GameFramework\Tests;
/**
 * @class GridTest
 * @author The Wass
 * @brief Collection of tests for the Grid data container
 * @description
 */
abstract class GridTest extends \PHPUnit_Framework_TestCase
{

    //Expected values

    /**
     * @brief Initialize *all* protected attributes of this class in the setup function.
     */
    public function setUp(){}

    /**
     * @brief Provide grid objects for testing.
     * @return array of arrays of grid objects
     */
    abstract public function gridProvider();

    /**
     * @brief Provide coordinate objects for testing.
     * @return array of arrays of coordinate objects
     */
    abstract public function coordinateProvider();
}