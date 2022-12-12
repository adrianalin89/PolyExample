<?php


class Configurable extends Product
{

    const TYPE = 'configurable';

    public function __construct($item)
    {
        $this->sku = $item['sku'];
        $this->status = $item['status'];
        $this->name = $item['Name'];
        $this->currency = $item['currency'];
        $this->options = $this->loadOptions($item['options']);
    }

    public function lowestPrice()
    {
        $lowestPrice = 999999999999;
        foreach ($this->options as $optionProducts) {
            $sellPrice = $optionProducts->getSellPrice();
            if ($lowestPrice > $sellPrice) {
                $lowestPrice = $sellPrice;
            }
        }
        return $lowestPrice;
    }

    public function priceView()
    {
        return '<span id="price">As low as: ' . $this->lowestPrice() . " " . $this->currency . '</span></br>';
    }

    private function optionList()
    {
        $result = '';
        foreach ($this->options as $label => $simpleProduct) {
            if ($simpleProduct->status) {
                $result .= '<option value="'.$simpleProduct->sku.'">'.$label.'</option>';
            }
        }
        return $result;
    }

    public function additional()
    {
        return '<label for="options">Choose a option:</label>
                <select name="cars" id="options">
                    <option value="0">Select a option</option>'.
            $this->optionList().
            '</select></br>';
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
        $sealableProduct = false;
        foreach ($this->options as $simpleProduct) {
            if ($simpleProduct->status && $simpleProduct->stock > 0) {
                $sealableProduct = true;
            }
        }
        return $sealableProduct && $this->status;
    }

    private function loadOptions($options)
    {
        include '../ProductData.php';
        $result = [];
        foreach ($options as $label => $sku) {
            $result[$label] = new Simple($productData[$sku]);
        }
        return $result;
    }

    static function loadScript()
    {
        return '<script>
        document.querySelectorAll(\'.item[data-type="configurable"] .add\').forEach(addElement => {
             addElement.addEventListener("click", event => {
                event.preventDefault();
                const qty = addElement.parentElement.querySelector("#qty").value;
                let optionSku = addElement.parentElement.querySelector("#options").value;
                let selectedProduct = productData[optionSku];
                if (qty < selectedProduct.stock) {
                    selectedProduct.stock = selectedProduct.stock-qty;
                    console.log("done");
                } else {
                    console.log("stock is lowe then order");
                }
            });
        });
        </script>';
    }
}
