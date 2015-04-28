<?php
/**
 * @file CellTest.php
 * @author The Wass
 * @brief This file tests the Cell class
 *
 * @version 1.0 - 2015-04-14
 * * Initial version
 */
namespace TheWass\Grid\Tests;

use TheWass\Grid\Cell;
/**
 * @class CellTest
 * @author The Wass
 * @brief Collection of tests for the Cell data container
 * @description  A cell must have the following attributes:
 * * Able set and get data of any type
 * * Able to store neighboring coordinates
 * * Able to get the weights of the stored neighbors
 * Checking neighbor validity is the Grid's job.
 */
class CellTest extends \PHPUnit_Framework_TestCase
{
    private $test;
    private $stub;

    public function setUp()
    {
        $this->test = new Cell();
        $this->stub = $this->getMockForAbstractClass('TheWass\Grid\Coordinate');
    }

    public function dataProvider()
    {
        return array(
            array(0),
            array(1),
            array(-1),
            array('str'),
            array(array(1)),
            array(new \stdClass())
        );
    }
    
    public function weightProvider()
    {
        return array(
            array(0, false),
            array(1, false),
            array(2, 2)
        );
    }

    /**
     * @brief Test setting and getting cell data.
     * @dataProvider dataProvider
     */
    public function testData($data)
    {
        //Test Magic
        $this->assertFalse(isset($this->test->property));
        $this->test->property = $data;
        $this->assertEquals($data, $this->test->property);
        unset($this->test->property);

        //Test ArrayAccess
        $this->assertFalse(isset($this->test['property']));
        $this->test['property'] = $data;
        $this->assertEquals($data, $this->test['property']);
        unset($this->test['property']);
        
        //Test same data
        $this->test->property = $data;
        $this->assertSame($this->test->property, $this->test['property']);
    }

    /**
     * @brief Test setting and getting neighbor weights.
     * @dataProvider weightProvider
     */
    public function testWeight($weight, $expected)
    {
        //Test get default weight
        $this->assertFalse($this->test->getWeight($this->stub));
        //Test weight
        $this->test->setWeight($this->stub, $weight);
        $this->assertSame($expected, $this->test->getWeight($this->stub));
    }

    /**
     * @brief Test setting a negative weight.
     * @expectedException RangeException
     */
    public function testNegativeWeight()
    {
        $this->test->setWeight($this->stub, -1);
    }
}
