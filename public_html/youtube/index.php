<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Профессиональный  мотосервис, выполняющий любые виды работ по ремонту и обслуживанию техники всех марок и моделей. Настройка, ремонт, сварка, регулировка, шиномонтаж и другие услуги в нашем сервисе. Сборка техники в индивидуальной комплектации.");
$APPLICATION->SetTitle("Наш канал на Youtube");
?>
<div class="maxwidth-theme">
    <?php $APPLICATION->IncludeComponent("bitrix:news", "youtube", Array(
        "IBLOCK_TYPE" => "aspro_next_content",	// Тип инфоблока
        "IBLOCK_ID" => "29",	// Инфоблок
        "USE_SEARCH" => "N",	// Разрешить поиск
        "USE_RSS" => "N",	// Разрешить RSS
        "USE_RATING" => "N",	// Разрешить голосование
        "USE_CATEGORIES" => "N",	// Выводить материалы по теме
        "USE_FILTER" => "N",	// Показывать фильтр
        // "FILTER_NAME" => "arRegionLink",	// Фильтр
        "FILTER_FIELD_CODE" => array(	// Поля
            0 => "",
            1 => "",
        ),
        "FILTER_PROPERTY_CODE" => array(	// Свойства
            0 => "",
            1 => "",
        ),
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "ID",	// Поле для второй сортировки новостей
        "SORT_ORDER2" => "DESC",	// Направление для второй сортировки новостей
        "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
        "SEF_MODE" => "Y",	// Включить поддержку ЧПУ
        "SEF_FOLDER" => "/youtube/",	// Каталог ЧПУ (относительно корня сайта)
        "AJAX_MODE" => "N",	// Включить режим AJAX
        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CACHE_TIME" => "100000",	// Время кеширования (сек.)
        "CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре
        "CACHE_GROUPS" => "N",	// Учитывать права доступа
        "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
        "SET_STATUS_404" => "Y",	// Устанавливать статус 404
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
        "ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
        "USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
        "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
        "LIST_FIELD_CODE" => array(	// Поля
            0 => "NAME",
            1 => "PREVIEW_TEXT",
            2 => "PREVIEW_PICTURE",
            3 => "",
        ),
        "LIST_PROPERTY_CODE" => array(	// Свойства
            0 => "",
            1 => "",
        ),
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
        "DISPLAY_NAME" => "N",	// Выводить название элемента
        "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
        "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
        "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
        "DETAIL_FIELD_CODE" => array(	// Поля
            0 => "PREVIEW_TEXT",
            1 => "DETAIL_TEXT",
            2 => "DETAIL_PICTURE",
            3 => "",
        ),
        "DETAIL_PROPERTY_CODE" => array(	// Свойства
            0 => "LINK_GOODS",
            1 => "LINK_STAFF",
            2 => "LINK_REVIEWS",
            3 => "LINK_PROJECTS",
            4 => "FORM_ORDER",
            5 => "FORM_QUESTION",
            6 => "DOCUMENTS",
            7 => "PHOTOS",
            8 => "LINK_SALE",
            9 => "VIDEO"
        ),
        "YOUTUBE_CHANEL_LINK" => "https://www.youtube.com/@pitlandru",
        "TITLE_BLOCK_ALL" => "Наш канал на Youtube",
        "DETAIL_DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
        "DETAIL_PAGER_TITLE" => "Страница",	// Название категорий
        "DETAIL_PAGER_TEMPLATE" => "",	// Название шаблона
        "DETAIL_PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
        "PAGER_TEMPLATE" => "main", //".default",	// Шаблон постраничной навигации
        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
        "PAGER_TITLE" => "Новости",	// Название категорий
        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
        "IMAGE_POSITION" => "left",	// Положение картинки анонса
        "USE_SHARE" => "Y",	// Показывать ссылки на соцсети
        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
        "USE_REVIEW" => "N",	// Разрешить отзывы
        "ADD_ELEMENT_CHAIN" => "Y",	// Включать название элемента в цепочку навигации
        "IMAGE_CATALOG_POSITION" => "left",	// Положение картинки каталогов
        "SHOW_DETAIL_LINK" => "Y",	// Отображать ссылку на детальную страницу
        "S_ASK_QUESTION" => "",	// Текст кнопки "Задать вопрос"
        "S_ORDER_SERVICE" => "",
        "T_GALLERY" => "",	// Текст подзаголовка "Галерея"
        "T_DOCS" => "",	// Текст подзаголовка "Документы"
        "T_GOODS" => "Товары по акции",	// Текст подзаголовка "Товары"
        "T_SERVICES" => "",	// Текст подзаголовка "Услуги"
        "T_PROJECTS" => "",	// Текст подзаголовка "Проекты"
        "T_REVIEWS" => "",	// Текст подзаголовка "Отзывы"
        "T_STAFF" => "Получите консультацию специалиста",	// Текст подзаголовка "Специалисты"
        "COMPONENT_TEMPLATE" => "services",
        "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
        "T_VIDEO" => "",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "VIEW_TYPE" => "row_block",
        "DETAIL_SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
        "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
        "SHOW_404" => "Y",	// Показ специальной страницы
        "MESSAGE_404" => "",
        "VIEW_TYPE_SECTION" => "row_block",
        "SHOW_CHILD_SECTIONS" => "Y",	// Показывать вложенные подразделы/элементы
        "GALLERY_TYPE" => "small",	// Тип галлереи
        "PREVIEW_REVIEW_TRUNCATE_LEN" => "255",
        "SECTIONS_TYPE_VIEW" => "sections_2",	// Шаблон страницы блока списка разделов
        "SECTION_TYPE_VIEW" => "section_1",	// Шаблон страницы блока списка подразделов
        "ELEMENT_TYPE_VIEW" => "element_1",	// Шаблон страницы блока детальной страницы
        "SHOW_SECTION_PREVIEW_DESCRIPTION" => "N",	// Показывать описание разделов
        "LINE_ELEMENT_COUNT" => "2",	// Количество разделов в строке
        "SECTION_ELEMENTS_TYPE_VIEW" => "list_elements_1",	// Шаблон страницы блока списка элементов
        "SHOW_SECTION_DESCRIPTION" => "Y",	// Показывать описание раздела в списке элементов
        "LINE_ELEMENT_COUNT_LIST" => "3",	// Количество элементов в строке на станице списка элементов
        "S_ORDER_SERVISE" => "",	// Текст кнопки "Заказть услугу"
        "FORM_ID_ORDER_SERVISE" => "",	// ИД формы для заказа услуги
        "T_NEXT_LINK" => "",	// Текст ссылки на следующий элемент
        "T_PREV_LINK" => "",	// Текст ссылки на список элементов
        "SHOW_NEXT_ELEMENT" => "N",	// Показывать ссылку на следующий элемент
        "IMAGE_WIDE" => "N",
        "DETAIL_STRICT_SECTION_CHECK" => "Y",
        "STRICT_SECTION_CHECK" => "Y",	// Строгая проверка раздела
        "SEF_URL_TEMPLATES" => array(
            "news" => "",
            "section" => "",
            "detail" => "#ELEMENT_CODE#/",
        )
    ),
        false
    );?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
