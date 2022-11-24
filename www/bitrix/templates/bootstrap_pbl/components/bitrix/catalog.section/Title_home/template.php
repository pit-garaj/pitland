<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="catalog-section">
    <div class="row equal">
        <? foreach ($arResult["ITEMS"] as $cell => $arElement): ?>

            <?
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col-md-6" style="margin-bottom: 10px;" id="<?= $this->GetEditAreaId($arElement['ID']); ?>">
                <div class="blash">
                    <div class="col-md-6" style="height: 100%;">
                        <? if (is_array($arElement["PREVIEW_PICTURE"])): ?>
                            <img
                                    class="img-responsive center-block"
                                    border="0"
                                    src="<?= $arElement["PREVIEW_PICTURE"]["SRC"] ?>"
                                    width="<?= $arElement["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                    height="<?= $arElement["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arElement["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arElement["PREVIEW_PICTURE"]["TITLE"] ?>"
                            />
                        <? elseif (is_array($arElement["DETAIL_PICTURE"])): ?>
                            <img
                                    border="0"
                                    class="img-responsive center-block"
                                    src="<?= $arElement["DETAIL_PICTURE"]["SRC"] ?>"
                                    width="<?= $arElement["DETAIL_PICTURE"]["WIDTH"] ?>"
                                    height="<?= $arElement["DETAIL_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arElement["DETAIL_PICTURE"]["ALT"] ?>"
                                    title="<?= $arElement["DETAIL_PICTURE"]["TITLE"] ?>"
                            />
                        <? endif ?>
                    </div>
                    <div class="col-md-6">
                        <div class="info">
                            <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"><h4><?= $arElement["NAME"] ?></h4></a>
                            <? foreach ($arElement["DISPLAY_PROPERTIES"] as $pid => $arProperty):
                                echo '<b>' . $arProperty["NAME"] . ':</b>&nbsp;';

                                if (is_array($arProperty["DISPLAY_VALUE"]))
                                    echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                                else
                                    echo $arProperty["DISPLAY_VALUE"];
                                ?>
                                <br/>
                            <? endforeach ?>
                            <b>Производитель:</b>&nbsp;<?= $arElement["IBLOCK_SECTION_NAME"] ?><br/>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-sm-12"><b>Цена:</b></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <? foreach ($arElement["PRICES"] as $code => $arPrice): ?>
                                        <? if ($arPrice["CAN_ACCESS"]): ?>
                                            <? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
                                                <s><?= $arPrice["PRINT_VALUE"] ?></s> <span
                                                        class="catalog-price"><?= $arPrice["PRINT_DISCOUNT_VALUE"] ?></span>
                                            <? else: ?><span
                                                    class="catalog-price"><?= $arPrice["PRINT_VALUE"] ?></span><? endif; ?>
                                        <? endif; ?>
                                    <? endforeach; ?>
                                </div>

                                <div class="col-sm-6">
                                    <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"
                                       class="btn btn-pbl btn-sm">Подробно</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
