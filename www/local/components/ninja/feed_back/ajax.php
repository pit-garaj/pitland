<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\PostDecodeFilter;

ob_start();
$input = file_get_contents('php://input');
$requestData = $input ? json_decode($input, true) : $_REQUEST;

$requestLang = $requestData['lang'] ?: 'ru';

// Подключение Bitrix
define('LANGUAGE_ID', $requestLang);
define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('DisableEventsCheck', true);
define('BX_SECURITY_SHOW_MESSAGE', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

Loader::includeModule('form');

$request = Application::getInstance()->getContext()->getRequest();
$request->addFilter(new PostDecodeFilter);

$getAction  = $request->getPost('action')  ?: '';
$getName    = $request->getPost('name')    ?: '';
$getPhone   = $request->getPost('phone')   ?: '';
$getDate    = $request->getPost('date')    ?: '';
$getComment = $request->getPost('comment') ?: '';

if($getAction === 'formFeedBack') {
    $arValues = [
        'form_text_52'   => $getName,
        'form_text_53'   => $getPhone,
        'form_text_54'   => $getDate,
        'form_text_55'   => $getComment,
        'licenses_popup' => 'Y',
    ];

    if ($RESULT_ID = CFormResult::Add(11, $arValues)) {
        echo 'Результат #' . $RESULT_ID . ' успешно создан';

        CFormResult::SetEvent($RESULT_ID);
        CFormResult::Mail($RESULT_ID);
    } else {
        global $strError;
        echo $strError;
    }
}

if($getAction === 'formTestDrive') {
    $arValues = [
        'form_text_56'   => $getName,
        'form_text_57'   => $getPhone,
        'licenses_popup' => 'Y',
    ];

    if ($RESULT_ID = CFormResult::Add(12, $arValues)) {
        echo 'Результат #' . $RESULT_ID . ' успешно создан';

        CFormResult::SetEvent($RESULT_ID);
        CFormResult::Mail($RESULT_ID);
    } else {
        global $strError;
        echo $strError;
    }
}
