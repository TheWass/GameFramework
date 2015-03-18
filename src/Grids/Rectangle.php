<?php
/**
 * @file Rectangle.php
 * @author The Wass
 * @brief This file defines square grid
 *
 * @version 1.0 - 2015-03-18
 * * Initial Version
 */
namespace TheWass\GameFramework\Grids;
/**
 * @class Rectangle
 * @author The Wass
 * @brief Rectangle grid with square cells.
 * @description description
 */
class Rectangle extends Grid
{
    protected $width;
    protected $height;

    /**
     * @brief Creates a rectangle grid
     * @param $width  - Maximum width  - 0 is infinite
     * @param $height - Maximum height - 0 is infinite
     * @return rectangle grid object
     */
    public function __construct($width = 0, $height = 0)
    {
        parent::__construct('FourSided', 'Square');
    }

    public function offsetSet(Coordinates\Square $coordinate, $data)
    {
        if (!is_a($data, 'FourSided')) {
            $newCell = new Cells\FourSided();
            $newCell->face = $data;
            $data = $newCell;
        }
        if ((abs($coordinate->x) > $width and $width != 0) or
            (abs($coordinate->y) > $height and $height != 0)) {
            throw new RangeException("Coordinate is outside of the grid.");
        }
        parent::offsetSet($coordinate, $data);
    }

    public function attach(Coordinates\Square $coordinate, $data)
    {
        $this->offsetSet($coordinate, $data);
    }

    public function getWeight(Coordinates\Square $coordinate1, Coordinates\Square $coordinate2)
    {
        return 1;
    }

    public function setWeight(Coordinates\Square $coordinate1, Coordinates\Square $coordinate2, $weight)
    {
        return false;
    }
}
