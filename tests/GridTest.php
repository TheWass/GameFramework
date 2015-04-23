<?php
/**
 * @file GridTest.php
 * @author The Wass
 * @brief This file tests the Grid class
 *
 * @version 1.0 - 2015-04-23
 * * Initial version
 */
namespace TheWass\GameFramework\Tests;
/**
 * @class GridTest
 * @author The Wass
 * @brief Collection of tests for the Grid data container
 * @description
 */
class GridTest extends \PHPUnit_Framework_TestCase
{
    private $grid;

    public function setUp()
    {
        $this->grid = $this->getMockForAbstractClass('TheWass\GameFramework\Grids\Grid');

        $this->grid->method('isInGrid')
             ->willReturn(true);
    }

    /**
     * @brief This creates a TestCoordinate object which has zero properties, and returns itself as its neighbor.
     * @return TestCoordinate object
     */
    public function createMockCoordinate()
    {
        $coord = $this->getMockBuilder('TheWass\GameFramework\Grids\Coordinates\Coordinate')
                      ->setMockClassName('TestCoordinate')
                      ->disableOriginalConstructor()
                      ->getMockForAbstractClass();

        $coord->method('calculateNeighbors')
              ->will($this->returnSelf());

        return $coord;
    }

    public function testMockCoordinate()
    {
        $coordinate = createMockCoordinate();
        var_dump($coordinate);
        assertEquals($coordinate, $coordinate->calculateNeighbors);
    }
}