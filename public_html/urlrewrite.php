<?php
$arUrlRewrite = array(
    6  =>
        array(
            'CONDITION' => '#^/bitrix/services/ymarket/([\\w\\d\\-]+)?(/)?(([\\w\\d\\-]+)(/)?)?#',
            'RULE'      => 'REQUEST_OBJECT=$1&METHOD=$4',
            'ID'        => '',
            'PATH'      => '/bitrix/services/ymarket/index.php',
            'SORT'      => 100,
        ),
    34 =>
        array(
            'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
            'RULE'      => 'alias=$1',
            'ID'        => NULL,
            'PATH'      => '/desktop_app/router.php',
            'SORT'      => 100,
        ),
    46 =>
        array(
            'CONDITION' => '#^/video/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
            'RULE'      => 'alias=$1&videoconf',
            'ID'        => 'bitrix:im.router',
            'PATH'      => '/desktop_app/router.php',
            'SORT'      => 100,
        ),
    7  =>
        array(
            'CONDITION' => '#^/personal/history-of-orders/#',
            'RULE'      => '',
            'ID'        => 'bitrix:sale.personal.order',
            'PATH'      => '/personal/history-of-orders/index.php',
            'SORT'      => 100,
        ),
    0  =>
        array(
            'CONDITION' => '#^/bitrix/services/ymarket/#',
            'RULE'      => '',
            'ID'        => '',
            'PATH'      => '/bitrix/services/ymarket/index.php',
            'SORT'      => 100,
        ),
    35 =>
        array(
            'CONDITION' => '#^/online/(/?)([^/]*)#',
            'RULE'      => '',
            'ID'        => NULL,
            'PATH'      => '/desktop_app/router.php',
            'SORT'      => 100,
        ),
    44 =>
        array(
            'CONDITION' => '#^/acrit.export/(.*)#',
            'RULE'      => 'path=$1',
            'ID'        => NULL,
            'PATH'      => '/acrit.export/index.php',
            'SORT'      => 100,
        ),
    33 =>
        array(
            'CONDITION' => '#^/stssync/calendar/#',
            'RULE'      => '',
            'ID'        => 'bitrix:stssync.server',
            'PATH'      => '/bitrix/services/stssync/calendar/index.php',
            'SORT'      => 100,
        ),
    9  =>
        array(
            'CONDITION' => '#^/contacts/stores/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/contacts/stores/index.php',
            'SORT'      => 100,
        ),
    14 =>
        array(
            'CONDITION' => '#^/company/vacancy/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/company/vacancy/index.php',
            'SORT'      => 100,
        ),
    8  =>
        array(
            'CONDITION' => '#^/contacts/stores/#',
            'RULE'      => '',
            'ID'        => 'bitrix:catalog.store',
            'PATH'      => '/contacts/stores/index.php',
            'SORT'      => 100,
        ),
    1  =>
        array(
            'CONDITION' => '#^/personal/order/#',
            'RULE'      => '',
            'ID'        => 'bitrix:sale.personal.order',
            'PATH'      => '/personal/order/index.php',
            'SORT'      => 100,
        ),
    15 =>
        array(
            'CONDITION' => '#^/company/staff/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/company/staff/index.php',
            'SORT'      => 100,
        ),
    12 =>
        array(
            'CONDITION' => '#^/company/news/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/company/news/index.php',
            'SORT'      => 100,
        ),
    42 =>
        array(
            'CONDITION' => '#^/info/brands/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/info/brands/index.php',
            'SORT'      => 100,
        ),
    13 =>
        array(
            'CONDITION' => '#^/projects/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/projects/index.php',
            'SORT'      => 100,
        ),
    2  =>
        array(
            'CONDITION' => '#^/personal/#',
            'RULE'      => '',
            'ID'        => 'bitrix:sale.personal.section',
            'PATH'      => '/personal/index.php',
            'SORT'      => 100,
        ),
    17 =>
        array(
            'CONDITION' => '#^/services/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/services/index.php',
            'SORT'      => 100,
        ),
    18 =>
        array(
            'CONDITION' => '#^/landings/#',
            'RULE'      => '',
            'ID'        => 'bitrix:catalog',
            'PATH'      => '/landings/index.php',
            'SORT'      => 100,
        ),
    47 =>
        array(
            'CONDITION' => '#^/catalog/#',
            'RULE'      => '',
            'ID'        => 'bitrix:catalog',
            'PATH'      => '/catalog/index.php',
            'SORT'      => 100,
        ),
    38 =>
        array(
            'CONDITION' => '#^/store/#',
            'RULE'      => '',
            'ID'        => 'bitrix:catalog.store',
            'PATH'      => '/store/index.php',
            'SORT'      => 100,
        ),
    5  =>
        array(
            'CONDITION' => '#^/news/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/news/index.php',
            'SORT'      => 100,
        ),
    11 =>
        array(
            'CONDITION' => '#^/auth/#',
            'RULE'      => '',
            'ID'        => 'aspro:auth.next',
            'PATH'      => '/auth/index.php',
            'SORT'      => 100,
        ),
    19 =>
        array(
            'CONDITION' => '#^/sale/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/sale/index.php',
            'SORT'      => 100,
        ),
    27 =>
        array(
            'CONDITION' => '#^/rest/#',
            'RULE'      => '',
            'ID'        => NULL,
            'PATH'      => '/bitrix/services/rest/index.php',
            'SORT'      => 100,
        ),
    28 =>
        array(
            'CONDITION' => '#^/blog/#',
            'RULE'      => '',
            'ID'        => 'bitrix:news',
            'PATH'      => '/blog/index.php',
            'SORT'      => 100,
        ),
    29 => array(
        "CONDITION" => "#^/sitemap/#",
        "RULE"      => "",
        "ID"        => "site_map:site_map",
        "PATH"      => "/sitemap/index.php",
    ),
    30 =>
        array (
            'CONDITION' => '#^/youtube/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/youtube/index.php',
            'SORT' => 100,
        ),
);
