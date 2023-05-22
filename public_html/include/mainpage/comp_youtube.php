<div class="maxwidth-theme">
    <div class="top_block">
        <h3 class="title_block mTitleBlock mTitleBlock__youtube">Наш Youtube-канал</h3>
    </div>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "youtube-main", Array(
        "IBLOCK_TYPE" => "aspro_next_content",	// Тип информационного блока (используется только для проверки)
        "IBLOCK_ID" => "29",	// Код информационного блока
        "NEWS_COUNT" => "5",	// Количество новостей на странице
        "SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
        "SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
        "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
        "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
        "FIELD_CODE" => array(	// Поля
            0 => "ID",
            1 => "NAME",
            2 => "DETAIL_PICTURE",
            3 => "DETAIL_PAGE_URL",
        ),
        "PROPERTY_CODE" => array(	// Свойства
            0 => "PERIOD",
            1 => "",
        ),
        "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
        "DETAIL_URL" => "/youtube/#ELEMENT_CODE#/",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
        "AJAX_MODE" => "N",	// Включить режим AJAX
        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
        "CACHE_GROUPS" => "N",	// Учитывать права доступа
        "PREVIEW_TRUNCATE_LEN" => "140",	// Максимальная длина анонса для вывода (только для типа текст)
        "ACTIVE_DATE_FORMAT" => "j F Y",	// Формат показа даты
        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
        "SET_STATUS_404" => "N",	// Устанавливать статус 404
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
        "PARENT_SECTION" => "",	// ID раздела
        "PARENT_SECTION_CODE" => "",	// Код раздела
        "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
        "PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
        "PAGER_TITLE" => "",	// Название категорий
        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
        "COMPONENT_TEMPLATE" => "front_akc",
        "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
        "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
        "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
        "FILTER_NAME" => "",	// Фильтр
        "TITLE_BLOCK" => "",	// Заголовок блока
        "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
        "ALL_URL" => "",	// Ссылка на все новости
        "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
        "SHOW_404" => "N",	// Показ специальной страницы
        "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
        "TITLE_BLOCK_ALL" => "",	// Заголовок на все новости
        "DISPLAY_DATE" => "Y",	// Отображать дату
        "SECTION_URL" => "",
        "IBLOCK_URL" => "/youtube/"
    ),
    false,
    array(
        "ACTIVE_COMPONENT" => "Y"
    )
);?>
    <div style="clear:both;"></div>
    <div class="bottom_nav" style="padding-top: 0;  text-align: center;">
        <a href="/youtube/" class="btn btn-default basket read_more">Больше видео</a>
    </div>
</div>
