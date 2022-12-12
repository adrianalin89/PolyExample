<?php

$productData = [
    '001' => ['sku' => '001',
    'status' => true,
    'stock' => 10,
    'Name' => 'Simple Product 1',
    'price' => '5',
    'special_price' => '0',
    'currency' => 'Eur',
    'type' => 'simple'],

    '002' => ['sku' => '002',
    'status' => true,
    'stock' => 15,
    'Name' => 'Simple Product 2',
    'price' => '6',
    'special_price' => '3',
    'currency' => 'Eur',
    'type' => 'simple'],

    '003' => ['sku' => '003',
    'status' => false,
    'stock' => 9,
    'Name' => 'Simple Product 3',
    'price' => '6',
    'special_price' => '2',
    'currency' => 'Eur',
    'type' => 'simple'],

    '004' => ['sku' => '004',
    'status' => true,
    'stock' => 0,
    'Name' => 'Simple Product 4',
    'price' => '4',
    'special_price' => '0',
    'currency' => 'Eur',
    'type' => 'simple'],


    '005' => ['sku' => '005',
    'status' => true,
    'Name' => 'Configurable Product 1',
    'currency' => 'Eur',
    'type' => 'configurable',
    'options' => [
        'opt1' => '001',
        'opt2' => '002'
    ]],

    '006' => ['sku' => '006',
    'status' => true,
    'Name' => 'Configurable Product 2',
    'currency' => 'Eur',
    'type' => 'configurable',
    'options' => [
        'opt1' => '001',
        'opt2' => '002',
        'opt3' => '003',
        'opt4' => '004',
    ]],

    '007' => ['sku' => '007',
    'status' => false,
    'Name' => 'Configurable Product 3',
    'currency' => 'Eur',
    'type' => 'configurable',
    'options' => [
        'opt1' => '001',
        'opt2' => '002'
    ]],

    '008' => ['sku' => '008',
    'status' => true,
    'Name' => 'Bundle Product 1',
    'price' => '12',
    'special_price' => '0',
    'currency' => 'Eur',
    'type' => 'bundle',
    'list' => ['001','002']],

    '009' => ['sku' => '009',
    'status' => true,
    'Name' => 'Bundle Product 2',
    'price' => '20',
    'special_price' => '0',
    'currency' => 'Eur',
    'type' => 'bundle',
    'list' => ['001','002','003','004']],

    '010' => ['sku' => '010',
    'status' => false,
    'Name' => 'Bundle Product 3',
    'price' => '10',
    'special_price' => '0',
    'currency' => 'Eur',
    'type' => 'bundle',
    'list' => ['001','002']],

];