<?php include 'ProductData.php';

foreach ($productData as $product) {
    
    switch ($product['type']):

        case 'simple':
            $showProduct = $product['status'] && $product['stock'];
            if ($showProduct) {
                echo '<div class="item" data-sku="'.$product['sku'].'">';
                echo 'Name: ' . $product['Name'] . '</br>';
                echo 'SKU: ' . $product['sku'] . '</br>';

                $sellPrice = $product['price'];
                if (array_key_exists('special_price', $product) && $product['special_price'] < $product['price'] && $product['special_price'] > 0) {
                    $sellPrice = $product['special_price'];
                }
                echo '<span id="price">Price: ' . $sellPrice . " " . $product['currency'] . '</span></br>';

                echo '<label for="qty">Qty:</label>';
                echo '<input type="number" id="qty" /></br>';
                echo '<a href="#" class="add" data-sku="'.$product['sku'].'">ADD</a></br>';
                echo '</div>';
                echo '</br><hr/></br></br>';
            }
            break;

        case 'configurable':
            $sealableProduct = false;
            foreach ($product['options'] as $sku) {
                if ($productData[$sku]['status'] && $productData[$sku]['stock']) {
                    $sealableProduct = true;
                }
            }
            $showProduct = $sealableProduct && $product['status'];
            if ($showProduct) {
                echo '<div class="item" data-sku="'.$product['sku'].'">';
                echo 'Name: ' . $product['Name'] . '</br>';
                echo 'SKU: ' . $product['sku'] . '</br>';

                $lowestPrice = 999999999999;
                foreach ($product['options'] as $sku) {
                    $sellPrice = $productData[$sku]['price'];
                    if (array_key_exists('special_price', $productData[$sku]) && $productData[$sku]['special_price'] < $productData[$sku]['price'] && $productData[$sku]['special_price'] > 0) {
                        $sellPrice = $productData[$sku]['special_price'];
                    }
                    if ($lowestPrice > $sellPrice) {
                        $lowestPrice = $sellPrice;
                    }
                }
                echo '<span id="price">As low as: ' . $lowestPrice . " " . $product['currency'] . '</span></br>';

                echo '
                <label for="options">Choose a option:</label>
                <select name="cars" id="options">';
                echo '<option value="0">Select a option</option>';
                foreach ($product['options'] as $label => $sku) {
                    $isAvailable = $productData[$sku]['status'];
                    if ($isAvailable) {
                        echo '<option value="'.$sku.'">'.$label.'</option>';
                    }
                }
                echo '</select></br>';

                echo '<label for="qty">Qty:</label>';
                echo '<input type="number" id="qty" /></br>';
                echo '<a href="#" class="add" data-sku="'.$product['sku'].'">ADD</a></br>';
                echo '</div>';
                echo '</br><hr/></br></br>';
            }
            break;

        case 'bundle':
            $isSealableAllProduct = true;
            foreach ($product['list'] as $sku){
                if (!$productData[$sku]['status'] && !$productData[$sku]['stock']) {
                    $isSealableAllProduct = false;
                }
            }
            $showProduct = $isSealableAllProduct && $product['status'];
            if ($showProduct) {
                echo '<div class="item" data-sku="'.$product['sku'].'">';
                echo 'Name: ' . $product['Name'] . '</br>';
                echo 'SKU: ' . $product['sku'] . '</br>';

                $sellPrice = $product['price'];
                if (array_key_exists('special_price', $product) && $product['special_price'] < $product['price'] && $product['special_price'] > 0) {
                    $sellPrice = $product['special_price'];
                }
                echo '<span id="price">Price: ' . $sellPrice . " " . $product['currency'] . '</span></br>';

                echo '
                <label>Product list:</label>
                <ul>';
                foreach ($product['list'] as $sku) {
                    $isAvailable = $productData[$sku]['status'] && $productData[$sku]['stock'];
                    if ($isAvailable) {
                        echo '<li>'.$productData[$sku]['Name'].'</li>';
                    }
                }
                echo '</ul></br>';

                echo '<label for="qty">Qty:</label>';
                echo '<input type="number" id="qty" /></br>';
                echo '<a href="#" class="add" data-sku="'.$product['sku'].'">ADD</a></br>';
                echo '</div>';
                echo '</br><hr/></br></br>';
            }
            break;

        default:
            var_dump($product);

    endswitch;
}

echo "<script>var data = '". json_encode($productData) ."'; </script>";
include 'Javascript.php';