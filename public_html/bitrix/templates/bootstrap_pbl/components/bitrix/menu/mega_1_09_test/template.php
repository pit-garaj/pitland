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


//print_r($arResult["ITEMS_IMG_DESC"]);
$this->setFrameMode(true); ?>
    <div class="container-fluid" style="margin-left: 0px;padding-left: 0px;">
        <div class="logo" style="display: inline-block; background: black; padding: 10px;">
            <a class="brand" href="/"><img src="/images/logo2.png"
                                           style="max-width: 200px;background: black"></a>
        </div>
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
                            <div class="dropdown-menu mega-dropdown-menu row row-centered row-conformity">


                                <? if (count($arItem['ITEMS']) > 6): ?>

                                    <? foreach ($arItem['ITEMS'] as $i_item => $arSubItem): ?>
                                        <? if ($i_item < 6): ?>
                                            <div class="col-sm-6">
                                                <div class="col-sm-1">
                                                    <div class="dropdown-header"
                                                         data-target="<?= crc32($arSubItem['LINK']) ?>">
                                                        <a
                                                                style="padding:0px" class="a_h1"
                                                                href="<?= $arSubItem['LINK'] ?>">
                                                            <img src="<?= $arResult["ITEMS_IMG_DESC"][crc32($arSubItem['LINK'])]['PICTURE'] ?>">
                                                            <span>
                                                    <?= $arSubItem['TEXT'] ?>
                                                    </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <? endif; ?>
                                    <? endforeach; ?>

                                <? else: ?>
                                    <? foreach ($arItem['ITEMS'] as $arSubItem): ?>

                                        <div class="col-sm-1">
                                            <div class="dropdown-header" data-target="<?= crc32($arSubItem['LINK']) ?>">
                                                <a
                                                        style="padding:0px" class="a_h1"
                                                        href="<?= $arSubItem['LINK'] ?>">
                                                    <img src="<?= $arResult["ITEMS_IMG_DESC"][crc32($arSubItem['LINK'])]['PICTURE'] ?>">
                                                    <span>
                                                    <?= $arSubItem['TEXT'] ?>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>

                                    <? endforeach; ?>
                                <? endif; ?>
                            </div>
                        <? endif; ?>
                    </li>
                <? endforeach; ?>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Что ищем?">
                </div>
            </form>
            <ul class="nav navbar-nav pull-right hidden-xs col-lg-2 col-xs-3 tel_block">
                <li><a style="padding: 3px" class="roistat-phone phones ya-phone" href="tel:+74953635299"> +7 (495) 363
                        52 99</a></li>
                <li><a style="padding: 3px" class="b24-web-form-popup-btn-10 btn btn-callback"><span
                                class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Обратный звонок</a></li>
            </ul>
        </div>
    </div>
<?
?>