<?php
/** @var array $_SERVER */

$hostname = $_SERVER['HTTP_HOST'];
$file = $_SERVER["DOCUMENT_ROOT"] . '/robots.php';
$filemtime = filemtime($file);

header('Content-Type: text/plain');
header('Content-Length: '.filesize($file));
header('Last-Modified: ' . gmdate('D, d M Y H:i:s ', $filemtime) . 'GMT');
header('ETag: ' . md5($file . $filemtime));
?>
User-Agent: *
Disallow: */index.php
Disallow: /bitrix/
Disallow: /basket/
Disallow: */filter/*
Disallow: /*show_include_exec_time=
Disallow: /*show_page_exec_time=
Disallow: /*show_sql_stat=
Disallow: /*bitrix_include_areas=
Disallow: /*clear_cache=
Disallow: /*clear_cache_session=
Disallow: /*ADD_TO_COMPARE_LIST
Disallow: /*ORDER_BY
Disallow: /*PAGEN
Disallow: /*?print=
Disallow: /*&print=
Disallow: /*print_course=
Disallow: /*?action=
Disallow: /*&action=
Disallow: /*register=
Disallow: /*forgot_password=
Disallow: /*change_password=
Disallow: /*login=
Disallow: /*logout=
Disallow: /*auth=
Disallow: /*backurl=
Disallow: /*back_url=
Disallow: /*BACKURL=
Disallow: /*BACK_URL=
Disallow: /*back_url_admin=
Disallow: /*?utm_source=
Disallow: /*?bxajaxid=
Disallow: /*RID=false
Disallow: /*quiz=yes
Disallow: /*?q=
Allow: /bitrix/components/
Allow: /bitrix/cache/
Allow: /bitrix/js/
Allow: /bitrix/templates/
Allow: /bitrix/panel/
Sitemap: https://<?=$hostname?>/sitemap.xml

User-Agent: Yandex
Disallow: */index.php
Disallow: /bitrix/
Disallow: /basket/
Disallow: */filter/*
Disallow: /*show_include_exec_time=
Disallow: /*show_page_exec_time=
Disallow: /*show_sql_stat=
Disallow: /*bitrix_include_areas=
Disallow: /*clear_cache=
Disallow: /*clear_cache_session=
Disallow: /*ADD_TO_COMPARE_LIST
Disallow: /*ORDER_BY
Disallow: /*PAGEN
Disallow: /*?print=
Disallow: /*&print=
Disallow: /*print_course=
Disallow: /*?action=
Disallow: /*&action=
Disallow: /*register=
Disallow: /*forgot_password=
Disallow: /*change_password=
Disallow: /*login=
Disallow: /*logout=
Disallow: /*auth=
Disallow: /*backurl=
Disallow: /*back_url=
Disallow: /*BACKURL=
Disallow: /*BACK_URL=
Disallow: /*back_url_admin=
Disallow: /*?utm_source=
Disallow: /*?bxajaxid=
Disallow: /*RID=false
Disallow: /*quiz=yes
Disallow: /*?q=
Allow: /bitrix/components/
Allow: /bitrix/cache/
Allow: /bitrix/js/
Allow: /bitrix/templates/
Allow: /bitrix/panel/
Host: https://<?=$hostname?>/
