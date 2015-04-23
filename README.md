#Grid
This is my implementation of a grid.  This grid is designed to be used in 2D or 3D games as a datastructure.

The grid is similar to a graph in function, however the grid's neighboring nodes are immutable.

The grid is an SPLObjectStorage of many cells.
Each cell has a coordinate which functions as its ID.
The cell has an SPLObjectStorage of all the neighbors and associated weights to the neighbors only if the weights are not default.
Otherwise, the neighbors are calculated based on the coordinate system.
