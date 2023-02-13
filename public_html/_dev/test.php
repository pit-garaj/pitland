<?php

use Ninja\Helper\Dbg;
use Ninja\Project\Catalog\CatalogCart;

require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );
?>



<a href="?action=all">Add</a>
<a href="?action=list">List</a>
<a href="?action=clear">Clear</a>

<hr />

<?php


$siteId = 's1';


switch ($_GET['action']) {
    case 'list':
        echo 'List';
        $result = CatalogCart::getData($siteId);
        Dbg::show($result);
        break;
    case 'all':
        echo 'Add';

        $productIds = [12200, 14326, 17510, 17509];
        foreach ($productIds as $id) {
            $result = CatalogCart::add($id, 1, $siteId);
            Dbg::show($result);
        }

        break;
    case 'clear':
        echo 'Clear';
        CatalogCart::clearCartBySiteId($siteId);
        break;
}


// \Ninja\Project\Catalog\CatalogCart::clearCartBySiteId($siteId);




// $data = \Ninja\Project\Catalog\CatalogCart::getUserCartItems('s1');

// \Ninja\Helper\Dbg::show($data);
?>


