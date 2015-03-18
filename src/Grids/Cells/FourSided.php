<?php
/**
 * @file FourSided.php
 * @author The Wass
 * @brief Defines a four-sided cell
 *
 * @version 1.0 - 2015-03-18
 * * Initial version
 */
namespace Wasser\GameFramework\Grids\Cells;
/**
 * @class FourSided
 * @author The Wass
 * @brief Defines a four-sided cell
 * @description The other verticies and edges are attached to neighboring cells.
 */
class FourSided extends Cell
{
    public $face;
    public $vertex;
    public $sEdge;
    public $wEdge;
}