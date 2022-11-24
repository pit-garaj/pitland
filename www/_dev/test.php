<?php

require( $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php' );



 $qq = \Ninja\Project\Shop\SectionAvailable::updateCountElements();

/**/
echo '<pre>';
print_r($qq);
echo '</pre>';

