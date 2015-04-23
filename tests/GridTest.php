<?php
/**
 * @file GridTest.php
 * @author The Wass
 * @brief This file tests the Grid class
 *
 * @version 1.0 - 2015-04-23
 * * Initial version
 */
namespace TheWass\Grid\Tests;
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
        //Trigger autoloader
        $this->getMockBuilder('TheWass\Grid\Coordinate')
             ->setMockClassName('TestCoordinate')
             ->disableOriginalConstructor()
             ->getMockForAbstractClass();

        $this->grid = $this->getMockbuilder('TheWass\Grid\Types\BaseGrid')
                           ->setConstructorArgs(array('TestCoordinate'))
                           ->getMockForAbstractClass();

        $this->grid->method('isInGrid')
             ->willReturn(true);
    }

    /**
     * @brief This creates a TestCoordinate object which has zero properties, and returns itself as its neighbor.
     * @return TestCoordinate object
     */
    public function createMockCoordinate()
    {
        $coord = $this->getMockBuilder('TheWass\Grid\Coordinate')
                      ->setMockClassName('TestCoordinate')
                      ->disableOriginalConstructor()
                      ->getMockForAbstractClass();

        $coord->method('calculateNeighbors')
              ->will($this->returnSelf());

        return $coord;
    }

    public function testMockCoordinate()
    {
        $coordinate = $this->createMockCoordinate();
        $this->assertEquals($coordinate, $coordinate->calculateNeighbors());
    }
}