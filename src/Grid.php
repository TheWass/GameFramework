<?php
/**
 * @file Grid.php
 * @author The Wass
 * @brief This file contains an interface for a basic grid functionality.
 *
 * @version 1.0 - 2015-03-02
 * * Initial Version
 * * Added full documentation
 * @version 1.1 - 2015-03-13
 * * Added the appropriate namespace for autoloading.
 * @version 2.0 - 2015-04-27
 * * Changed typechecking to an actual grid, rather than a generic graph
 */
namespace TheWass\Grid;
/**
 * @interface Grid
 * @author The Wass
 * @brief Standard interface for a grid datastructure.
 * @description This is a basic interface for implementing grid data structures.
 * The difference between a graph and a grid is graphs can dynamically connect and disconnect
 * nodes.  Grid nodes have fixed neighbors which do not change.
 */
interface Grid
{
    /**
     * @brief Tests if there exists at least one arc from $source to $destination.
     * @param Coordinate $source - Source node
     * @param Coordinate $destination - Destination node
     * @return boolean True if $source is adjacent to $destination.
     */
    public function isAdjacent(Coordinate $source, Coordinate $destination);

    /**
     * @brief Lists all neighbors for $coordinate
     * @param Coordinate $coordinate - Coordinate to query
     * @return Coordinate[] - An array of neighbors on success. See implementation for type information.
     */
    public function getNeighbors(Coordinate $coordinate);

    /**
     * @brief Returns the Cell data.
     * @param Coordinate $coordinate - Coordinate to query
     * @return Cell
     */
    public function getCell(Coordinate $coordinate);

    /**
     * @brief Set the Cell data.
     * @param Coordinate $coordinate - Coordinate to query
     * @param Cell $value - Value to set the coordinate
     * @return void
     */
    public function setCell(Coordinate $coordinate, Cell $value);

    /**
     * @brief Gets the weight value of the arc between two nodes.
     * @param Coordinate $source - Source Coordinate
     * @param Coordinate $destination - Destination Coordinate
     * @return integer|false - False if not adjacent
     */
    public function getWeight(Coordinate $source, Coordinate $destination);

    /**
     * @brief Sets the weight value of the arc between two nodes. (returns $weight on success)
     * @param Coordinate $source - Source Coordinate
     * @param Coordinate $destination - Destination Coordinate
     * @param integer $weight - Value to set the arc
     * @return void
     */
    public function setWeight(Coordinate $source, Coordinate $destination, $weight);
}
