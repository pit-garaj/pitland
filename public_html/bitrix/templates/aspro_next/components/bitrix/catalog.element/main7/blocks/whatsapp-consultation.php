<?php
/** @var array $arResult */
?>
<div class="whatsapp-consultation-wrapper">
  <div class="whatsapp-consultation">
    <div class="whatsapp-consultation__text">Проконсультироваться в WhatsApp</div>
    <div class="whatsapp-consultation__info">
      <div class="whatsapp-consultation__info-item">
        <a
          href="https://wa.me/79689984616"
          class="consultation__link whatsapp-consultation__info-link" target="_blank"
          rel="nofollow">Северный салон в&nbsp;ТЦ&nbsp;Декстер</a>
          <?php if ($arResult['STORES_AMOUNT']['IP_DEXTER']): ?> <span class="whatsapp-consultation__amount">(остаток <?=$arResult['STORES_AMOUNT']['IP_DEXTER']?>)</span><?php endif; ?>
      </div>
      <div class="whatsapp-consultation__info-item">
        <a href="https://wa.me/79689984612"
           class="consultation__link whatsapp-consultation__info-link"
           target="_blank"
           rel="nofollow">Южный салон в&nbsp;ТЦ&nbsp;Формула&nbsp;Х</a>
          <?php if ($arResult['STORES_AMOUNT']['96531d2a-c1dc-11ea-8455-2cfda1745e0d']): ?> <span class="whatsapp-consultation__amount">(остаток <?=$arResult['STORES_AMOUNT']['96531d2a-c1dc-11ea-8455-2cfda1745e0d']?>)</span><?php endif; ?>
      </div>
    </div>
  </div>
</div>
