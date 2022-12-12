<?php


class Bundle extends Product
{
    const TYPE = 'bundle';

    public function __construct($item)
    {
        $this->sku = $item['sku'];
        $this->status = $item['status'];
        $this->name = $item['Name'];
        $this->price = $item['price'];
        $this->specialPrice = $item['special_price'];
        $this->currency = $item['currency'];
        $this->list = $this->loadList($item['list']);
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

    public function getListView()
    {
        $results = '';
        foreach ($this->list as $product) {
            $results .= '<li>'.$product->name.'</li>';
        }
        return $results;
    }

    public function additional()
    {
        return '<label>Product list:</label>
                <ul>'.
            $this->getListView().
            '</ul></br>';
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

    public function showInView()
    {
        $isSealableAllProduct = true;
        foreach ($this->list as $simpleProduct){
            if (!$simpleProduct->status && $simpleProduct->stock > 0) {
                $isSealableAllProduct = false;
            }
        }
        return $isSealableAllProduct && $this->status;
    }

    private function loadList($list)
    {
        include '../ProductData.php';
        $result = [];
        foreach ($list as $sku) {
            $result[] = new Simple($productData[$sku]);
        }
        return $result;
    }

    static function loadScript()
    {
        return '<script>
        document.querySelectorAll(\'.item[data-type="bundle"] .add\').forEach(addElement => {
             addElement.addEventListener("click", event => {
                event.preventDefault();
                var sku = addElement.dataset.sku;
                const product = productData[sku];
                const qty = addElement.parentElement.querySelector("#qty").value;
                let isAllInStock = true;
                product.list.forEach(sku => {
                    let item = productData[sku];
                    if(item.stock < qty){
                        isAllInStock = false;
                    } else {
                        item.stock = item.stock - qty;
                    }
                })
                if(isAllInStock) {
                    console.log("done");
                } else {
                    console.log("invalid qty");
                }
            });
        });
        </script>';
    }

}