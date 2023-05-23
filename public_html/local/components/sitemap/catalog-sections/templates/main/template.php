<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arResult */
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach($arResult['list'] as $item): ?>
      <sitemap><loc><?=$item?></loc></sitemap>
    <?php endforeach; ?>
</sitemapindex>