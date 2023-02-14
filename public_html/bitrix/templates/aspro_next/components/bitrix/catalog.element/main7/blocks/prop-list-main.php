<?php

/** @var object $USER */
/** @var array $arResult */

if (!empty($arResult['SHOW_PROPS_MAIN'])) {
    ?>
  <div class=" props-list-block">
    <div class="props-list-block__head"><?= GetMessage('PROPERTIES_TAB') ?></div>
    <div class="props-list-block__body">
      <table class="props_list preview">
        <tbody>
        <?php
        $i = 0;
        foreach ($arResult["SHOW_PROPS_MAIN"] as $key => $arProp) {
          ?>
          <tr>
            <td class="char_name">
              <div class="props_item"><span itemprop="name"><?= $arProp['NAME'] ?></span></div>
            </td>
            <td class="char_value">
              <span itemprop="value">
                  <?php if (count($arProp["DISPLAY_VALUE"]) > 1): ?>
                      <?= implode(', ', $arProp['DISPLAY_VALUE']) ?>
                  <?php else: ?>
                      <?= $arProp['DISPLAY_VALUE'] ?>
                  <?php endif; ?>
              </span>
            </td>
          </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
      </table>
    </div>
    <div class="props-list-block__footer">
      <a class="more_block icons_fa color_link"
         href="#props_list"
         onclick="$('a[href=\'#props\']').click()"><?= GetMessage('MORE_TEXT_BOTTOM') ?></a>
    </div>
  </div>
    <?php
}

