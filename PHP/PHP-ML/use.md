Clustering is about grouping similar objects together. It is widely used for pattern recognition. `Clustering` comes under `unsupervised machine learning`, therefore there is no training needed.  PHP-ML has support for the following clustering algorithms

 - k-Means
 - dbscan

# k-Means

k-Means separates the data into `n` groups of equal variance. This means that we need to pass in a number `n` which would be the number of clusters we need in our solution. The following code will help bring more clarity

    // Our data set
    $samples = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9]];
    
    // Initialize clustering with parameter `n`
    $kmeans = new KMeans(3);
    $kmeans->cluster($samples); // return [0=>[[7, 8]], 1=>[[8, 7]], 2=>[[1,1]]]

Note that the output contains 3 arrays because because that was the value of `n` in `KMeans` constructor. There can also be an optional second parameter in the constructor which would be the `initialization method`. For example consider

    $kmeans = new KMeans(4, KMeans::INIT_RANDOM);

`INIT_RANDOM` places a completely random centroid while trying to determine the clusters. But just to avoid the centroid being too far away from the data, it is bound by the space boundaries of data.

The default constructor `initialization method` is [kmeans++](https://en.wikipedia.org/wiki/K-means%2B%2B) which selects centroid in a smart way to speed up the process.

# DBSCAN

As opposed to `KMeans`, `DBSCAN` is a density based clustering algorithm which means that we would not be passing `n` which would determine the number of clusters we want in our result. On the other hand this requires two parameters to work

  1. **$minSamples :** The minimum number of objects that should be present in a cluster
  2. **$epsilon :** Which is the maximum distance between two samples for them to be considered as in the same cluster.

A quick sample for the same is as follows

    // Our sample data set
    $samples = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9]];
    
    $dbscan = new DBSCAN($epsilon = 2, $minSamples = 3);
    $dbscan->cluster($samples); // return [0=>[[1, 1]], 1=>[[8, 7]]]

The code is pretty much self explanatory. One major difference is that there is no way of knowing the number of elements in output array as opposed to KMeans.

## Practical Case

Let us now have a look on using clustering in real life scenario

> Clustering is widely used in `pattern recognition` and `data mining`. Consider that you have a content publishing application. Now in order to retain your users they should look at content that they love. Let us assume for the sake of simplicity that if they are on a specific webpage for more that a minute and they scoll to bottom then they love that content. Now each of your content will be having a unique identifier with it and so will the user. Make cluster based on that and you will get to know which segment of users have a similar content taste. This in turn could be used in recommendation system where you can assume that if some users of same cluster love the article then so will others and that can be shown as recommendations on your application."