<?php

use Ninja\Project\Catalog\CatalogCartStore;

require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );


$testData1 = [
    'title' => 'Test 1',
    'params' => [
        '13274' => [
            'quantity' => 1,
            'stores' => [
                '96531d2a-c1dc-11ea-8455-2cfda1745e0d' => 3,
                'IP_DEXTER' => 3,
            ],
        ],
        '13273' => [
            'quantity' => 1,
            'stores' => [
                '96531d2a-c1dc-11ea-8455-2cfda1745e0d' => 3,
                'IP_DEXTER' => 5,
            ],
        ],
    ],
    'result' => [
        'sd' => [
            '13274' => 1,
            '13273' => 1,
        ],
    ],
];

$distributeProductsByStores = CatalogCartStore::distributeProductsByStores($testData1['params']);
if ($testData1['result'] === $distributeProductsByStores) {
    echo $testData1['title'] . ': success' . '<br />';
} else {
    echo $testData1['title'] . ': error' . '<br />';
}


// --------------------


$testData2 = [
    'title' => 'Test 2',
    'params' => [
        '12059' => [
            'quantity' => 1,
            'stores' => [
                '96531d2a-c1dc-11ea-8455-2cfda1745e0d' => 1,
                'IP_DEXTER' => 5,
            ],
        ],
    ],
    'result' => [
        'sd' => [
            '12059' => 1,
        ],
    ],
];

$distributeProductsByStores = CatalogCartStore::distributeProductsByStores($testData2['params']);
if ($testData2['result'] === $distributeProductsByStores) {
    echo $testData2['title'] . ': success' . '<br />';
} else {
    echo $testData2['title'] . ': error' . '<br />';
}


// --------------------


$testData3 = [
    'title' => 'Test 3',
    'params' => [
        '9909' => [
            'quantity' => 1,
            'stores' => [
                'IP_DEXTER' => 5,
                '96531d2a-c1dc-11ea-8455-2cfda1745e0d' => 0,
            ],
        ],
        '12048' => [
            'quantity' => 1,
            'stores' => [
                'IP_DEXTER' => 0,
                '96531d2a-c1dc-11ea-8455-2cfda1745e0d' => 1,
            ],
        ],
        '12883' => [
            'quantity' => 1,
            'stores' => [
                'IP_DEXTER' => 0,
                '96531d2a-c1dc-11ea-8455-2cfda1745e0d' => 1,
            ],
        ],
    ],
    'result' => [
        'sm' => [
            '12048' => 1,
            '12883' => 1,
        ],
        'sd' => [
            '9909' => 1,
        ],
    ],
];

$distributeProductsByStores = CatalogCartStore::distributeProductsByStores($testData3['params']);
if ($testData3['result'] === $distributeProductsByStores) {
    echo $testData3['title'] . ': success' . '<br />';
} else {
    echo $testData3['title'] . ': error' . '<br />';
}
