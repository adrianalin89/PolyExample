<?php

abstract class Product
{
    static function loadObject(Product $item)
    {
        return $item;
    }

    static function render(Product $product)
    {
        if ($product->showInView()) {
            echo '<div class="item" data-sku="'.$product->sku.'" data-type="'.$product::TYPE.'">
                Name: ' . $product->name . '</br>
                SKU: ' . $product->sku . '</br>'.
                $product->priceView().
                $product->additional().
                $product->qtySelector().
                $product->addToCartBtn().
                '</div>
            </br><hr/></br></br>';
        }
    }
}