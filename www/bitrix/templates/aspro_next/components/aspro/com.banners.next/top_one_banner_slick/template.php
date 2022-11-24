<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if($arResult['ITEMS']):?>
<div class="slider one-time">
    <? foreach ($arResult['ITEMS'] as $item): ?>
    <div>
        <? if($item['CODE'] === 'sexylena'): ?>
        	<div class="mBanLena">
                <div class="wrapper_inner">
                    <div class="mBanLena__girl"></div>
                    <div class="row flexbox">
                        <div class="col-md-7 col-sm-7 col-xs-8">
                            <div class="mBanLena__head">Раздень Лену и подбери себе Питбайк!</div>
                            <div class="mBanLena__desc">
                                <p>Ответь на несколько вопросов, чтобы мы могли подобрать тебе модель питбайка.</p>
                                <p>Чем больше ответов ты дашь, тем меньше вещей останется на девушке и <b>больше бонусов ты получишь!</b></p>
                            </div>

                            <div class="mBanLena__icons">
                                <img src="/local/build/img/showcase/lena/icons.png" class="mBanLena__icons-md" />
                                <img src="/local/build/img/showcase/lena/icons-sm.png" class="mBanLena__icons-sm" />
                            </div>

                            <div class="mBanLena__footer">
                                <a href="javascript:showPitbikePopup();" class="mBanLena__btn">Раздеть и подобрать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <? else: ?>
            <?
            $background = is_array($item['DETAIL_PICTURE']) ? $item['DETAIL_PICTURE']['SRC'] : $this->GetFolder().'/images/background.jpg';
            $target = $item['PROPERTIES']['TARGETS']['VALUE_XML_ID'];
            ?>
            <? if (!empty($item['PROPERTIES']['URL_STRING']['VALUE']) && $item['PROPERTIES']['TEXT_POSITION']['VALUE_XML_ID'] === 'image'): ?><a href="<?=$item['PROPERTIES']['URL_STRING']['VALUE']?>"><? endif; ?>
            <div class="mBanDef <?=$item['PROPERTIES']['TEXT_POSITION']['VALUE_XML_ID']?>" style="background-image: url('<?=$background?>') !important;">
	            
                <div class="mBanDef__block <?=$item['PROPERTIES']['TEXT_POSITION']['VALUE_XML_ID']?>">
                    <? if($item['NAME'] && $item['PROPERTIES']['TEXT_POSITION']['VALUE_XML_ID'] !== 'image'): ?>
                        <div class="mBanDef__title">
                            <? if ($item['PROPERTIES']['URL_STRING']['VALUE']): ?>
                                <a href="<?= $item['PROPERTIES']['URL_STRING']['VALUE'] ?>" <?= (strlen($target) ? 'target="' . $target . '"' : '') ?>><?=strip_tags($item['~NAME'], '<br><br/><br />'); ?></a>
                            <? else: ?>
                                <?=strip_tags($item['~NAME'], '<br><br/><br />'); ?>
                            <? endif; ?>
                        </div>
                    <? endif; ?>

                    <? if($item['PREVIEW_TEXT']): ?>
                        <div class="mBanDef__desc"><?=$item['PREVIEW_TEXT']?></div>
                    <? endif; ?>
                </div>
                
            </div>
            <? if (!empty($item['PROPERTIES']['URL_STRING']['VALUE'])): ?></a><? endif; ?>            
        <? endif; ?>
    </div>
    <? endforeach; ?>
</div>
<?endif;?>
