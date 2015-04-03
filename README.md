#GameFramework
This is a grid based game framework written in PHP.  
It is my 'playground' to explore different aspects of programming using object oriented principles.

##Grid
The grid is an SPLObjectStorage of many cells.
Each cell has a coordinate which functions as its ID.
The cell has an SPLObjectStorage of all the neighbors and associated weights to the neighbors only if the weights are not default.
Otherwise, the neighbors are calculated based on the coordinate system.
