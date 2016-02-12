Grid
====
Travis: [![Travis Status](https://travis-ci.org/TheWass/Grid.svg?branch=master)](https://travis-ci.org/TheWass/Grid.svg?branch=master)  
Scrutinizer:
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/TheWass/Grid/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/TheWass/Grid/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/TheWass/Grid/badges/build.png?b=master)](https://scrutinizer-ci.com/g/TheWass/Grid/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/TheWass/Grid/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/TheWass/Grid/?branch=master)

This is my implementation of a grid.  This grid is designed to be used in 2D or 3D games as a datastructure.

The grid is similar to a graph in function, however the grid's neighboring nodes are immutable.

The grid is an SPLObjectStorage of many cells.
Each cell has a coordinate which functions as its ID.
The cell has an SPLObjectStorage of all the neighbors and associated weights to the neighbors only if the weights are not default.
Otherwise, the neighbors are calculated based on the coordinate system.

