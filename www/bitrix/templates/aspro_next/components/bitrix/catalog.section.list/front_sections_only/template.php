<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arResult */
/** @var array $arParams */
?>
<?php $this->setFrameMode(true); ?>
<?php if ($arResult['SECTIONS']): ?>
  <div class="sections_wrapper">
      <?php if ($arParams["TITLE_BLOCK"] || $arParams["TITLE_BLOCK_ALL"]): ?>
        <div class="top_block">
          <h3 class="title_block"><?= $arParams["TITLE_BLOCK"] ?></h3>
          <a href="<?= SITE_DIR . $arParams["ALL_URL"] ?>"><?= $arParams["TITLE_BLOCK_ALL"]; ?></a>
        </div>
      <?php endif; ?>
    <div class="list items">
      <div class="row margin0 flexbox">
          <?php foreach ($arResult['SECTIONS'] as $arSection):
              $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'],
                  CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
              $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'],
                  CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"),
                  array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM'))); ?>

              <?php if ($arSection['UF_COUNT_ELEMENTS'] > 0): ?>
            <div class="col-md-3 col-sm-4 col-xs-6">
          <div class="item" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
              <?php if ($arParams["SHOW_SECTION_LIST_PICTURES"] !== "N"): ?>
              <div class="img shine">
                  <?php if ($arSection["PICTURE"]["SRC"]): ?>
                      <?php $img = CFile::ResizeImageGet($arSection["PICTURE"]["ID"],
                          array("width" => 330, "height" => 240), BX_RESIZE_IMAGE_EXACT,
                          true); ?>
                    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>"
                       class="thumb"><img src="<?= $img["src"] ?>"
                                          alt="<?= ($arSection["PICTURE"]["ALT"] ?: $arSection["NAME"]) ?>"
                                          title="<?= ($arSection["PICTURE"]["TITLE"] ?: $arSection["NAME"]) ?>"/></a>
                  <?php elseif ($arSection["~PICTURE"]): ?>
                      <?php $img = CFile::ResizeImageGet($arSection["~PICTURE"],
                          array("width" => 3300, "height" => 240), BX_RESIZE_IMAGE_EXACT,
                          true); ?>
                    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>"
                       class="thumb"><img src="<?= $img["src"] ?>"
                                          alt="<?= ($arSection["PICTURE"]["ALT"] ?: $arSection["NAME"]) ?>"
                                          title="<?= ($arSection["PICTURE"]["TITLE"] ?: $arSection["NAME"]) ?>"/></a>
                  <?php else: ?>
                    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>"
                       class="thumb"><img src="<?= SITE_TEMPLATE_PATH ?>/images/catalog_category_noimage.png"
                                          alt="<?= $arSection["NAME"] ?>"
                                          title="<?= $arSection["NAME"] ?>"/></a>
                  <?php endif; ?>
              </div>

              <div class="name">
                <a href="<?= $arSection['SECTION_PAGE_URL'] ?>"
                   class="dark_link"><?= $arSection['NAME'] ?></a>
              </div>
              </div>
              </div>
              <?php endif; ?>

          <?php endif; ?>

          <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
