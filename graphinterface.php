<?php
/**
 *  This defines the interface at which other objects can access a grid data structure
 */
interface GraphInterface
{
    public function isAdjacent($node1, $node2);
    public function getNeighbors($node1);
    public function connect($node1, $node2);
    public function disconnect($node1, $node2);
    public function getNode($node);
    public function setNode($node, $value);
    public function getWeight($node1, $node2);
    public function setWeight($node1, $node2, $weight);
}