<?php
/**
 * @file graphinterface.php
 * @author The Wass
 * @brief This file contains an interface for a basic graph functionality.
 *
 * @version 1.0.0 - 2015-03-02
 * * Initial Version
 * * Added full documentation
 * @version 1.0.1 - 2015-03-13
 * * Added the appropriate namespace for autoloading.
 */
namespace Wasser\GameFramework\Interfaces;
/**
 * @interface GraphInterface
 * @author The Wass
 * @brief Standard interface for a graph datastructure.
 * @description This is a basic interface for implementing graph data structures.
 * Notice: All functions in this interface MUST handle exceptions within the implementing class.
 * Classes using and trusting this interface should not be held responsible for your garbage.
 * Make it a custom error instead.
 */
interface GraphInterface
{
    /**
     * @brief Tests if there exists at least one arc from $node1 to $node2.
     * @param $node1 - Source node
     * @param $node2 - Destination node
     * @return Boolean True if $node1 is adjacent to $node2.
     */
    public function isAdjacent($node1, $node2);

    /**
     * @brief Lists all neighbors for $node
     * @param $node - Node to query
     * @return Array(Mixed): An array of neighbors on success. See implementation for type information.
     */
    public function getNeighbors($node);

    /**
     * @brief Connects two nodes with an arc.
     * @param $node1 - Source node
     * @param $node2 - Destination node
     * @return Mixed: False on failure.  See implementation for success values.
     */
    public function connect($node1, $node2);

    /**
     * @brief Disconnects two nodes.
     * @param $node1 - Source node
     * @param $node2 - Destination node
     * @return Mixed: False on failure.  See implementation for success values.
     */
    public function disconnect($node1, $node2);

    /**
     * @brief Returns the node data.
     * @param $node - Parameter_Description
     * @return Mixed: False on failure.  Node data on success.
     */
    public function getNode($node);

    /**
     * @brief Set the node data.
     * @param $node  - Node to query
     * @param $value - Value to set the node
     * @return Mixed: False on failure.  See implementation for success values.
     */
    public function setNode($node, $value);

    /**
     * @brief Gets the weight value of the arc between two nodes.
     * @param $node1 - Source node
     * @param $node2 - Destination node
     * @return Mixed: False on failure.  The weight of the arc on success.
     */
    public function getWeight($node1, $node2);

    /**
     * @brief Sets the weight value of the arc between two nodes.
     * @param $node1  - Source node
     * @param $node2  - Destination node
     * @param $weight - Value to set the arc
     * @return Mixed: False on failure.  See implementation for success values.
     */
    public function setWeight($node1, $node2, $weight);
}
