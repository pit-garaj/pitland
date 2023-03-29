<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */

if ($arParams["SET_TITLE"] === "Y") {
	$APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}

if (!empty($arResult["ORDER"])): ?>
	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=Loc::getMessage("SOA_ORDER_SUC", array(
					"#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"]->toUserTime()->format('d.m.Y H:i'),
					"#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]
				))?>
				<?php if (!empty($arResult['ORDER']["PAYMENT_ID"])): ?>
					<?=Loc::getMessage("SOA_PAYMENT_SUC", ["#PAYMENT_ID#" => $arResult['PAYMENT'][$arResult['ORDER']["PAYMENT_ID"]]['ACCOUNT_NUMBER']])?>
				<?php endif ?>
				<?php if ($arParams['NO_PERSONAL'] !== 'Y'): ?>
					<br /><br />
					<?=Loc::getMessage('SOA_ORDER_SUC1', ['#LINK#' => $arParams['PATH_TO_PERSONAL']])?>
				<?php endif; ?>
			</td>
		</tr>
	</table>

	<?php
	/*
	if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y')
	{
		if (!empty($arResult["PAYMENT"]))
		{
			foreach ($arResult["PAYMENT"] as $payment)
			{
				if ($payment["PAID"] != 'Y')
				{
					if (!empty($arResult['PAY_SYSTEM_LIST'])
						&& array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
					)
					{
						$arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];

						if (empty($arPaySystem["ERROR"]))
						{
							?>
							<br /><br />

							<table class="sale_order_full_table">
								<tr>
									<td class="ps_logo">
										<div class="pay_name"><?=Loc::getMessage("SOA_PAY") ?></div>
										<?=CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0\" style=\"width:100px\"", "", false) ?>
										<div class="paysystem_name"><?=$arPaySystem["NAME"] ?></div>
										<br/>
									</td>
								</tr>
								<tr>
									<td>
										<? if ($arPaySystem["ACTION_FILE"] <> '' && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
											<?
											$orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
											$paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
											?>
											<script>
												window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
											</script>
										<?=Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&PAYMENT_ID=".$paymentAccountNumber))?>
										<? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
										<br/>
											<?=Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&pdf=1&DOWNLOAD=Y"))?>
										<? endif ?>
										<? else: ?>
											<?=$arPaySystem["BUFFERED_OUTPUT"]?>
										<? endif ?>
									</td>
								</tr>
							</table>

							<?
						}
						else
						{
							?>
							<span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
							<?
						}
					}
					else
					{
						?>
						<span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
						<?
					}
				}
			}
		}
	}
	else
	{
		?>
		<br /><strong><?=$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']?></strong>
		<?
	}
	*/
	?>

	<br /><br />
	<table class="sale_order_full_table" style="background-color: #ffd200;">
		<tr>
			<td style="padding: 0; font-weight: bold;">
				Простите, оплата на сайте временно не принимается.<br />
				Для уточнения стоимости заказа можете позвонить по номеру <a href="tel:+74953635299">+7 (495) 363 52 99</a>.<br />
				<a href="tel:88006005790">8 (800) 600-57-90</a> для бесплатных звонков на территории РФ.<br />
				Или ожидайте звонка менеджера Pitland.ru для подтверждения заказа.
			</td>
		</tr>
	</table>


<?php else: ?>
    <?php
    $orderId = urlencode($arResult['ACCOUNT_NUMBER']);
    $orderIds = explode('-', $orderId);
    ?>

    <?php if (count($orderIds) > 1): ?>
        <?php
        $orderIds = array_map(static function ($item) {
            return '№' . $item;
        }, explode('-', $orderId));
        ?>
    <table class="sale_order_full_table">
      <tr>
        <td>
          <p>Внимание, в связи с нахождением товара на 2-х разных складах, созданы заказы <b><?=implode(', ', $orderIds)?></b>.</p>
          <p>С Вами свяжутся 2 менеджера</p>

            <?php if ($arParams['NO_PERSONAL'] !== 'Y'): ?>
              <p><?=Loc::getMessage('SOA_ORDER_SUC1', ['#LINK#' => '/personal/'])?></p>
            <?php endif; ?>
        </td>
      </tr>
    </table>
    <?php else: ?>
    <b><?= Loc::getMessage("SOA_ERROR_ORDER") ?></b>
    <br/><br/>

    <table class="sale_order_full_table">
      <tr>
        <td>
          <p>
              <?= Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])]) ?>
              <?= Loc::getMessage("SOA_ERROR_ORDER_LOST1") ?>
          </p>
        </td>
      </tr>
    </table>
    <?php endif ?>
<?php endif ?>
