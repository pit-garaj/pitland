<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true ); ?>
<?if($arResult["SECTIONS"]){?>

<div class="sections_wrapper">
	<div class="list items">
		<div class="row margin0 flexbox">
			<?php foreach ($arResult['SECTIONS'] as $arSection): ?>
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="item">

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
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?}?>