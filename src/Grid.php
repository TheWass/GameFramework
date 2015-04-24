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
 */
namespace TheWass\Grid;
/**
 * @interface Grid
 * @author The Wass
 * @brief Standard interface for a grid datastructure.
 * @description This is a basic interface for implementing grid data structures.
 * The difference between a graph and a grid is graphs can dynamically connect and disconnect
 * nodes.  Grid nodes have fixed neighbors which do not change.
 * @notice All functions in this interface MUST handle exceptions within the implementing class.
 * Classes using and trusting this interface should not be held responsible for your garbage.
 * Make it a custom error instead.
 */
interface Grid
{
    /**
     * @brief Tests if there exists at least one arc from $source to $destination.
     * @param $source - Source node
     * @param $destination - Destination node
     * @return Boolean True if $source is adjacent to $destination.
     */
    public function isAdjacent(Coordinate $source, Coordinate $destination);

    /**
     * @brief Lists all neighbors for $node
     * @param $node - Node to query
     * @return Array(Coordinate): An array of neighbors on success. See implementation for type information.
     */
    public function getNeighbors(Coordinate $node);

    /**
     * @brief Returns the node data.
     * @param $node - Node to query
     * @return Mixed: False on failure.  Node data on success.
     */
    public function getNode(Coordinate $node);

    /**
     * @brief Set the node data.
     * @param $node  - Node to query
     * @param $value - Value to set the node
     * @return Mixed: False on failure.  See implementation for success values.
     */
    public function setNode(Coordinate $node, $value);

    /**
     * @brief Gets the weight value of the arc between two nodes.
     * @param $source - Source node
     * @param $destination - Destination node
     * @return Mixed: False on failure.  The weight of the arc on success.
     */
    public function getWeight(Cell $source, Coordinate $destination);

    /**
     * @brief Sets the weight value of the arc between two nodes.
     * @param $source  - Source node
     * @param $destination  - Destination node
     * @param $weight - Value to set the arc
     * @return Mixed: False on failure.  See implementation for success values.
     */
    public function setWeight(Cell $source, Coordinate $destination, $weight);
}
