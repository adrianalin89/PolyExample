<?php

class Simple extends Product

{
    const TYPE = 'simple';

    public function __construct($item)
    {
        $this->sku = $item['sku'];
        $this->status = $item['status'];
        $this->name = $item['Name'];
        $this->stock = $item['stock'];
        $this->price = $item['price'];
        $this->specialPrice = $item['special_price'];
        $this->currency = $item['currency'];
    }

    public function getSellPrice()
    {
        $sellPrice = $this->price;
        if ($this->specialPrice < $this->price && $this->specialPrice > 0) {
            $sellPrice = $this->specialPrice;
        }
        return $sellPrice;
    }

    public function priceView()
    {
        return '<span id="price">Price: ' . $this->getSellPrice() . " " . $this->currency . '</span></br>';
    }

    public function qtySelector()
    {
        return '<label for="qty">Qty:</label>
                <input type="number" id="qty" /></br>';
    }

    public function addToCartBtn()
    {
        return '<a href="#" class="add" data-sku="'.$this->sku.'">ADD</a></br>';
    }

    public function additional()
    {
        return '';
    }

    public function showInView()
    {
        return $this->status && $this->stock;
    }

    static function loadScript()
    {
        return '<script>
        document.querySelectorAll(\'.item[data-type="simple"] .add\').forEach(addElement => {
             addElement.addEventListener("click", event => {
                event.preventDefault();
                var sku = addElement.dataset.sku;
                const product = productData[sku];
                const qty = addElement.parentElement.querySelector("#qty").value;
                 if (qty < product.stock) {
                    product.stock = product.stock-qty;
                    console.log("done");
                } else {
                    console.log("stock is lowe then order");
                }
            });
        });
        </script>';
    }
}
