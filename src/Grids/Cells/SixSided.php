<?php
/**
 * @file SixSided.php
 * @author The Wass
 * @brief Defines a six-sided cell
 *
 * @version 1.0 - 2015-03-18
 * * Initial version
 */
namespace Wasser\GameFramework\Grids\Cells;
/**
 * @class SixSided
 * @author The Wass
 * @brief Defines a six-sided cell
 * @description The other verticies and edges are attached to neighboring cells.
 */
class SixSided extends Cell
{
    public $face;
    public $eVertex;
    public $wVertex;
    public $eEdge;
    public $sEdge;
    public $wEdge;
}