<script>
    const productData = JSON.parse(data);

    document.querySelectorAll('.add').forEach(addElement => {
        addElement.addEventListener('click', event => {
            event.preventDefault();
            var sku = addElement.dataset.sku;
            const product = productData[sku];
            const qty = addElement.parentElement.querySelector('#qty').value;

            switch (product.type) {
                case 'simple':
                    if (qty < product.stock) {
                        product.stock = product.stock-qty;
                        console.log('done');
                    } else {
                        console.log('stock is lowe then order')
                    }
                    break;

                case 'configurable':
                    let optionSku = addElement.parentElement.querySelector('#options').value;
                    let selectedProduct = productData[optionSku];
                    if (qty < selectedProduct.stock) {
                        selectedProduct.stock = selectedProduct.stock-qty;
                        console.log('done');
                    } else {
                        console.log('stock is lowe then order')
                    }
                    break

                case 'bundle':
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
                        console.log('done');
                    } else {
                        console.log('invalid qty');
                    }
                    break
            }

        });
    });



</script>