<?php
use Bitrix\Main\Web\Json;
use Ninja\Project\Catalog\CatalogStore;

/** @var array $arResult */
?>
<div class="whatsapp-consultation-wrapper">
  <div class="whatsapp-consultation">
    <div class="whatsapp-consultation__text">Проконсультироваться в WhatsApp</div>
    <div class="whatsapp-consultation__info">
        <?php if ($arResult['STORES_AMOUNT'][CatalogStore::DEXTER_IP_CODE]): ?>
      <div class="whatsapp-consultation__info-item">
        <a
          href="https://wa.me/79672340771"
          class="consultation__link whatsapp-consultation__info-link" target="_blank"
          rel="nofollow"
        >Северный салон в&nbsp;ТЦ&nbsp;Декстер</a> <span class="whatsapp-consultation__amount">(остаток <span class="amount_<?=CatalogStore::DEXTER_IP_CODE?>"><?=$arResult['STORES_AMOUNT'][CatalogStore::DEXTER_IP_CODE]?></span>)</span>
      </div>
        <?php endif ?>
        <?php if ($arResult['STORES_AMOUNT'][CatalogStore::MAIN_CODE]): ?>
          <div class="whatsapp-consultation__info-item">
            <a href="https://wa.me/79672340771"
               class="consultation__link whatsapp-consultation__info-link"
               target="_blank"
               rel="nofollow"
            >Южный салон в&nbsp;ТЦ&nbsp;Формула&nbsp;Х</a> <span class="whatsapp-consultation__amount">(остаток <span class="amount_<?=CatalogStore::MAIN_CODE?>"><?=$arResult['STORES_AMOUNT'][CatalogStore::MAIN_CODE]?></span>)</span>
          </div>
        <?php endif ?>
        <?php if ($arResult['STORES_AMOUNT'][CatalogStore::REMOTE_STORE]): ?>
          <div class="whatsapp-consultation__info-item">
            <a href="https://wa.me/79672340771"
               class="consultation__link whatsapp-consultation__info-link"
               target="_blank"
               rel="nofollow"
            >Склад удаленного хранения</a> <span class="whatsapp-consultation__amount">(остаток <span class="amount_<?=CatalogStore::REMOTE_STORE?>"><?=$arResult['STORES_AMOUNT'][CatalogStore::REMOTE_STORE]?></span>)</span>
          </div>
        <?php endif ?>
    </div>
  </div>
</div>

<?php if ($arResult['STORES_OFFERS_AMOUNT']): ?>
  <script>
  window['checkStories'] = ['<?=CatalogStore::DEXTER_IP_CODE?>', '<?=CatalogStore::MAIN_CODE?>'];
  window['storesOffersAmount'] = '<?=Json::encode($arResult['STORES_OFFERS_AMOUNT'])?>';
  </script>
<?php endif; ?>
