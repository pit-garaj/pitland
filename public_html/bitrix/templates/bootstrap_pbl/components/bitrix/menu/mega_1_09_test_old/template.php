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

$this->setFrameMode(true); ?>
    <div class="container-fluid">
        <a class="brand" href="/"><img src="/bitrix/templates/bootstrap_pbl/images/footerlogo.png"
                                       style="max-width: 60px;background: black"></a>
    <div style="display: inline-block; vertical-align: middle;">
            <ul class="nav navbar-nav">
                <?
                foreach ($arResult['REAL'] as $i => $arItem):
                    if (empty($arItem['LINK'])) continue;
                    ?>
                    <li class="dropdown mega-dropdown">
                        <a href="<?= $arItem['LINK'] ?>"
                           <? if (!empty($arItem['ITEMS'])): ?>data-target="<?= crc32($arItem['LINK']) ?>"
                           data-toggle="dropdown"<? endif;
                        ?> class="dropdown-toggle"><?= $arItem['TEXT'] ?></a>
                        <? if (!empty($arItem['ITEMS'])): ?>
                            <ul class="dropdown-menu mega-dropdown-menu row">
                                <? foreach ($arItem['ITEMS'] as $arSubItem): ?>
                                    <? if (crc32($arSubItem['LINK']) == "1325989649") continue; ?>
                                    <? if (crc32($arSubItem['LINK']) == "961804227") continue; ?>
                                    <? if (crc32($arSubItem['LINK']) == "1214009380") continue; ?>
                                    <? if (crc32($arSubItem['LINK']) == "1946099409") continue; ?>
                                    <? if (crc32($arSubItem['LINK']) == "1212953487") {
                                        ?>
                                        <div class="col-sm-4">
                                            <li class=""><a
                                                        style="display: block; padding: 3px 20px; clear: both; font-weight: 600; line-height: 1.428571429; color: black; white-space: normal;font-size: 18px;"
                                                        class="a_h1" href="/shop/tovari/dlya_pitbaykov/">Смотреть
                                                    всё</a></li>
                                        </div>
                                        <div style="text-align: center;padding-top: 10px;" class="col-sm-2"><a
                                                href="<?= $arSubItem['LINK'] ?>"><img width="80"
                                                                                      src="<?= $arResult["ITEMS_IMG_DESC"][crc32($arSubItem['LINK'])]['PICTURE'] ?>"></a>
                                        </div><?
                                    }
                                ; ?>
                                    <? if (crc32($arSubItem['LINK']) == "3609382782") {
                                        ?>
                                        <div style="text-align: center;padding-top: 10px;" class="col-sm-2"><a
                                                href="https://jazzmoto.ru/stunt/"><img width="80"
                                                                                       src="<?= $arResult["ITEMS_IMG_DESC"][crc32($arSubItem['LINK'])]['PICTURE'] ?>"></a>
                                        </div><?
                                    }
                                ; ?>
                                    <? if (crc32($arSubItem['LINK']) == "3174098374") {
                                        ?>
                                        <div style="text-align: center;padding-top: 10px;" class="col-sm-2"><a
                                                href="<?= $arSubItem['LINK'] ?>"><img width="80"
                                                                                      src="<?= $arResult["ITEMS_IMG_DESC"][crc32($arSubItem['LINK'])]['PICTURE'] ?>"></a>
                                        </div><?
                                    }
                                ; ?>
                                    <? if (crc32($arSubItem['LINK']) == "4097576888") {
                                        ?>
                                        <div style="text-align: center;padding-top: 10px;" class="col-sm-2"><a
                                                href="<?= $arSubItem['LINK'] ?>"><img width="80"
                                                                                      src="<?= $arResult["ITEMS_IMG_DESC"][crc32($arSubItem['LINK'])]['PICTURE'] ?>"></a>
                                        </div><?
                                    }
                                ; ?>
                                    <? if (crc32($arSubItem['LINK']) == "1212953487") continue; ?>
                                    <? if (crc32($arSubItem['LINK']) == "3609382782") continue; ?>
                                    <? if (crc32($arSubItem['LINK']) == "3174098374") continue; ?>
                                    <? if (crc32($arSubItem['LINK']) == "4097576888") continue; ?>
                                    <li class="<? if (crc32($arSubItem['LINK']) == "860179298"): ?>col-sm-12<? else: ?>col-sm-6<? endif; ?> <? if (crc32($arSubItem['LINK']) == "623057073" || crc32($arSubItem['LINK']) == "332114285"): ?> col-sm-offset-6 <? endif; ?>">
                                        <ul>
                                            <li class="dropdown-header" data-target="<?= crc32($arSubItem['LINK']) ?>">
                                                <a
                                                        style="padding:0px" class="a_h1"
                                                        href="<?= $arSubItem['LINK'] ?>"><?= $arSubItem['TEXT'] ?></a>
                                            </li>
                                            <? if (!empty($arSubItem['ITEMS'])): ?>
                                            <ul class="sub-sect <? if (count($arSubItem['ITEMS']) > 12): ?>col-sm-4<? else: ?>col-sm-12<? endif; ?>">
                                                <? foreach ($arSubItem['ITEMS'] as $i => $arSubSubItem): ?>
                                                    <? $i++ ?>
                                                    <? if ($i % 12 == 0): ?>
                                                        </ul>
                                                        <ul class="sub-sect col-sm-4">
                                                    <? endif; ?>
                                                    <li>
                                                        <a class="a_sub"
                                                           data-target="<?= crc32($arSubSubItem['LINK']) ?>"
                                                           href="<?= $arSubSubItem['LINK'] ?>"><?= $arSubSubItem['TEXT'] ?></a>
                                                    </li>
                                                <? endforeach; ?>
                                                </ul>
                                            <? endif; ?>
                                        </ul>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        <? endif; ?>
                    </li>
                <? endforeach; ?>
            </ul>
    </div>
    </div>
<?
?>