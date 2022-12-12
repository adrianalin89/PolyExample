<?php include '../ProductData.php';
      include 'LoaderClass.php';

$products = new LoaderClass($productData);
foreach ($products->getData() as $product) {
    Product::render($product);
}
echo $products->getScripts();