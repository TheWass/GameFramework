<?php
/**
 * @file FourSidedCell.php
 * @author The Wass
 * @brief This file defines a four-sided cell
 *
 * @version 1.0.0 - 2015-03-13
 * * Initial Version
 */
namespace Wasser\GameFramework\Grids\Cells;
/**
 * @class FourSidedCell
 * @author The Wass
 * @brief brief
 * @description description
 */
class FourSidedCell extends Cell
{
    public $face;
    public $sEdge;
    public $wEdge;
    public $vertex;
}