<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
/** @var array $templateData */
/** @var array $arParams */
/** @var @global CMain $APPLICATION */

use Bitrix\Main\Loader;

global $APPLICATION;
?>
<?php if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY'])): ?>
<?php
    $loadCurrency = false;
    if (!empty($templateData['CURRENCIES'])) {
        $loadCurrency = Loader::includeModule('currency');
    }
    CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
  ?>
	<?php if ($loadCurrency): ?>
	<script type="text/javascript">
		BX.Currency.setCurrencies(<?=$templateData['CURRENCIES']?>);
	</script>
	<?php endif ?>
<?php endif ?>
