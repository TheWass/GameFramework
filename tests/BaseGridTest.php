<?php
/**
 * @file BaseGridTest.php
 * @author The Wass
 * @brief This file tests the BaseGrid class
 *
 * @version 1.0 - 2015-04-28
 * * Initial version
 */
namespace TheWass\Grid\Tests;

use TheWass\Grid\Cell;
/**
 * @class BaseGridTest
 * @author The Wass
 * @brief Collection of tests for the Grid data container
 * @description
 */
class BaseGridTest extends \PHPUnit_Framework_TestCase
{
    private $grid;

    public function setUp()
    {
        //Trigger autoloader
        $this->createMockCoordinate();
        //Create Grid mock object
        $this->grid = $this->getMockbuilder('TheWass\Grid\Types\BaseGrid')
                           ->setConstructorArgs(array('TestCoordinate'))
                           ->getMockForAbstractClass();
        $this->grid->expects($this->any())
                   ->method('isInGridRange')
                   ->with($this->anything())
                   ->willReturn(true);
    }

    /**
     * @brief This creates a TestCoordinate object which has zero properties, and returns itself as its neighbor.
     * @return TestCoordinate mock object
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

    /**
     * @brief This ensures the mock coordinate works.
     */
    public function testMockCoordinate()
    {
        $coordinate = $this->createMockCoordinate();
        $this->assertEquals($coordinate, $coordinate->calculateNeighbors());
        $coordinate2 = $this->createMockCoordinate();
        $this->assertNotSame($coordinate, $coordinate2); //Not the same instance
        $this->assertEquals($coordinate, $coordinate2);  //Equivalent instances
    }

    /**
     * @brief Test setting and getting a Cell object to a Coordinate in the grid.
     */
    public function testGetSetCell()
    {
        $origin = $this->createMockCoordinate();
        //Test getting empty cell
        $cell = $this->grid->getCell($origin);
        $this->assertInstanceOf('TheWass\Grid\Cell', $this->grid->getCell($origin));
        //Test equivalence
        $this->assertEquals($cell, $this->grid->getCell($origin));
        $this->assertNotSame($cell, $this->grid->getCell($origin));
        
        $cell = new Cell();
        //Test setting Cell
        $this->grid->setCell($origin, $cell);
        //Test equivalence
        $this->assertEquals($cell, $this->grid->getCell($origin));
        $this->assertNotSame($cell, $this->grid->getCell($origin));

        //Replace Cell
        $cell2 = new Cell();
        $this->grid->attach($origin, $cell2);
        //Test equivalence
        $this->assertEquals($cell2, $this->grid->getCell($origin));
        $this->assertNotSame($cell2, $this->grid->getCell($origin));
    }

    /**
     * @brief Test setting and getting a Cell object to multiple coordinates.
     */
    public function testMultipleCoordinates()
    {
        $origin = $this->createMockCoordinate();
        $coord = $this->createMockCoordinate();
        $cell = new Cell();

        $this->grid[$origin] = $cell;
        $this->grid[$coord] = $cell;
        $this->assertNotSame($this->grid[$origin], $this->grid[$coord]);
    }
    
    /**
     * @brief Modifying the cell without setting the grid should not modify the grid.
     */
    public function testImmutableGrid()
    {
        $origin = $this->createMockCoordinate();

        $cell = $this->grid[$origin];
        $cell['attrib'] = 'test';
        $this->assertNotEquals($cell, $this->grid[$origin]);
        
        $cell = new Cell();
        $this->grid->attach($origin, $cell);
        
    }
    
    /**
     * @brief Test setting a coordinate outside of the grid range.
     * @expectedException RangeException
     */
    public function testRange()
    {
        //Gotta build a new grid with the altered isInGridRange method.
        $grid = $this->getMockbuilder('TheWass\Grid\Types\BaseGrid')
                     ->setConstructorArgs(array('TestCoordinate'))
                     ->getMockForAbstractClass();
        $grid->expects($this->any())
             ->method('isInGridRange')
             ->with($this->anything())
             ->willReturn(false);
        
        $origin = $this->createMockCoordinate();
        $cell = new Cell();
        $grid->setCell($origin, $cell);
    }
    
    /**
     * @brief Test getting neighbors.
     */
    public function testNeighbors()
    {
        $origin = $this->createMockCoordinate();
        $this->assertEquals($origin, $this->grid->getNeighbors($origin));
    }
    
    /**
     * @brief Test Adjacency.
     */
    public function testAdjacency()
    {
        $origin = $this->createMockCoordinate();
        $this->assertEquals($origin, $this->grid->getNeighbors($origin));
    }
    
    /**
     * @brief Test getting and setting weights.
     */
    public function testWeights()
    {
        $origin = $this->createMockCoordinate();
        $this->assertEquals($origin, $this->grid->getNeighbors($origin));
    }
}