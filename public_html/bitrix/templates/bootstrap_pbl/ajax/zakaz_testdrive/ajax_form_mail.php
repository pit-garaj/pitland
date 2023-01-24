<?
/**
 * Created by PhpStorm.
 * User: nip4fun
 * Date: 01.11.17
 * Time: 16:13
 */

// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?if (!empty($_POST["name"]) && !empty($_POST["Email"])):
    $name = strip_tags($_POST['name']);
    $phone = strip_tags($_POST['phone']);
    $email = strip_tags($_POST['Email']);
    $sug = strip_tags($_POST['sug']);
    $href = strip_tags($_POST['href']);
    $bike_name = strip_tags($_POST['bike_name']);

    $arEventFields= array(
        "LINK" => $href,
        "NAME" => $name,
        "M_MAIL" => "info@pitbikeland.ru",
        "F_MAIL" => $email,
        "MSG" => $sug,
        "BIKE" => $bike_name,
        "PHONE" => $phone
    );

    CEvent::Send("ZAPIS_TEST_DRIVE", SITE_ID, $arEventFields, "N", 55);

    unset($_POST["name"]);
    unset($_POST["phone"]);
    unset($_POST["Email"]);
    unset($_POST["sug"]);
    unset($_POST["href"]);
    unset($_POST["bike_name"]);

    ?>
    <div align="center" style="color: green;position: relative;padding: 20px;">Запрос успешно отправлен</div>
    <script>$('button#submit').addClass('hide');</script>
<?elseif (empty($_POST["name"]) || empty($_POST["Email"])):?>
    <div align="center" style="color: red;position: relative;padding: 20px;">Пожалуйста заполните обязательные поля</div>
    <script>$('.modal-body').removeClass('hide');</script>
<?endif;?>


<?
// подключение служебной части эпилога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");