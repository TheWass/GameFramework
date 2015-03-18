<?php
/**
 * @file Cell.php
 * @author The Wass
 * @brief This file defines a template for a single cell of a grid.
 *
 * @version 1.0 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 *
 * @version 2.0 - 2015-03-17
 * * Restructured the design for the Cell class
 * * Cell definitions are now stored as JSON; this class functions like a factory for the cells.
 * * Eliminates having many relatively empty class definitions.
 * * Enabled dynamic Cell creation.
 * 
 * @version 2.1 - 2015-03-18
 * * Removed coordinates from the Cell class.  The Grid will handle the neighbor functions.
 * * Ahh, screw it.  I'll deal with multiple micro-classes. Too much of a pain with autoloading.
 * * Reverted some changes made in version 2.0.
 */
namespace Wasser\GameFramework\Grids\Cells;
/**
 * @class Cell
 * @author The Wass
 * @brief Abstract class to facilitate constructing a cell and validating a coordinate for it.
 * @description This class is defined by the name of the child class, and any attributes that it has.
 * 
 */
abstract class Cell
{
    private $data;

    final public function __construct()
    {
        // Get the child's attributes
        $childAttribs = get_class_vars(get_class($this));
        foreach ($childAttribs as $attribute) {
            $this->data[$attribute] = null;
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data) {
            return $this->data[$name];
        } else {
            throw new BadMethodCallException("$name is not a valid property.");
        }
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->data) {
            $this->data[$name] = $value;
        } else {
            throw new BadMethodCallException("$name is not a valid property.");
        }
    }
}
