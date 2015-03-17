<?php
/**
 * @file Cell.php
 * @author The Wass
 * @brief This file defines a template for a single cell of a grid.
 *
 * @version 1.0.0 - 2015-03-13
 * * Reorganized files
 * * Added Namespacing
 *
 * @version 2.0.0 - 2015-03-17
 * * Restructured the design for the Cell class
 * * Cell definitions are now stored as JSON; this class functions like a factory for the cells.
 * * Eliminates having many relatively empty class definitions.
 */
namespace Wasser\GameFramework\Grids\Cells;
/**
 * @class Cell
 * @author The Wass
 * @brief Abstract class to facilitate constructing a cell and validating a coordinate for it.
 * @description This class is defined by the name of the child class.  The child does not need
 * to have any functions and can be entirely empty.  Using eval allows for a dynamic celltype
 * if necessary:
 * 
 *     eval("class {$cellType} extends Cell {}");
 * 
 * This way, the OOP principles remain in place, and I don't have to deal with a bunch of classes
 * that only have five or six attributes and nothing else.
 * 
 */
abstract class Cell
{
    private $coordinates;
    private $properties;
    /**
     * @brief Brief
     * @param $coords   - Parameter_Description
     * @return Return_Description
     */
    final public function __construct($coords)
    {
        // Check to ensure the coordinates are actually coordinates.
        if (in_array('Coordinate', class_parents($coords)) {
            $this->coordinates = $coords;
        } else {
            throw new InvalidArgumentException("$coords must extend the Coordinate class.");
        }
        
        // Check to see if the child class has any attributes
        // If so, apply those.  If not, go find them in the JSON file.
        $child = get_class($this);
        $childAttribs = get_class_vars($child))
        if (empty($childAttribs)) {
            // Validate the cell type
            $fileContents = file_get_contents("./CellDefinitions.json")
            if ($fileContents === false) {
                throw new RuntimeException("CellDefinitions.json could not be opened.");
            }
            $cellDefinitions = json_decode($fileContents, true)
            if ($cellDefinitions === null) {
                throw new RuntimeException("CellDefinitions.json could not be decoded.");
            }

            // Add the cell properties to this instance.
            if (array_key_exists($child, $cellDefinitions)) {
                foreach ($cellDefinitions[$child] as $attribute) {
                    $this->properties[$attribute] = null;
                }
            } else {
                throw new InvalidArgumentException("$child is not defined in CellDefinitions.json");
            }
        } else {
            foreach ($childAttribs as $attribute) {
                $this->properties[$attribute] = null;
            }
        }

    }

    public function getCoordinates()
    {
        if (func_num_args() == 0) {
            return $this->coordinates;
        } else {
            return $this->coordinates->func_get_arg(0);
        }
    }

    public function getNeighbors()
    {
        return $this->coordinates->calculateNeighbors();
    }

    public function __get($name)
    {
        switch (strtolower($name)) {
            case 'coordinates':
                return $this->getCoordinates();
                break;
            case 'neighbors':
                return $this->getNeighbors();
                break;
            case 'celltype':
            case 'type':
                return $this->type;
                break;
            default:
                if (array_key_exists($name, $this->properties) {
                    return $this->properties[$name];
                } else {
                    throw new BadMethodCallException("$name is not a valid property.");
                }
        }
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->properties) {
            $this->properties[$name] = $value;
        } else {
            throw new BadMethodCallException("$name is not a valid property.");
        }
    }
}
