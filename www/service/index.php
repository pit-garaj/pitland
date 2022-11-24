<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Профессиональный  мотосервис, выполняющий любые виды работ по ремонту и обслуживанию техники всех марок и моделей. Настройка, ремонт, сварка, регулировка, шиномонтаж и другие услуги в нашем сервисе. Сборка техники в индивидуальной комплектации.");
$APPLICATION->SetTitle("Мотосервис Питбайкленд");
?>
    <style>
        .tb td {
            padding: 10px 0px 10px 15px;
            font-size: 16px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #dadada;
        }

        .tb tr .cantry {
            text-align: left;
        }

        .tb tr .sity {
            width: 135px;
            text-align: left;
        }

        .tb tr .th_adres {
            width: 135px;
            text-align: left;
        }

        .tb tr .th_phone {
            width: 140px;
        }

        .tb tr .company {

            text-align: center;
        }

        .tb tr:nth-child(odd) td {
            background: #e6e6e6;
        }

        .tb {
            width: 100%;
            border-collapse: collapse;
        }

        .tb th.global {
            padding: 10px 15px;
            text-align: left;
            color: #fff;
            vertical-align: middle;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
            background: #000;
        }

        #global-d {
            padding: 10px 0px 10px 15px;
            text-align: center;
            vertical-align: middle;
            color: #fff;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
            background: #000;
        }

        .tb th.pod {
            padding: 10px 15px;
            text-align: left;
            color: #000;
            vertical-align: middle;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
        }
    </style>

    <p>Что такое Моточасы? - мы считаем, что это время проведенное с удовольствием, а не потраченное на ремонт твоего питбайка или мотоцикла.</p>
    <br>
    <div class="row" >
        <img src="/images/home/service1.jpg" class="col-sm-6 no-padding" style="float: left;">
        <p style="float: right;text-align: center;" class="col-sm-6 no-padding"><br class="hidden-xs">Залогом долговечной службы аппарата является его правильное и своевременное обслуживание. Мы сами являемся владельцами мототехники и тестируем все, что продаем и обслуживаем. Это помогает нам эффективнее решать вопросы сервиса, с которыми к нам обращаются клиенты. Мы знаем так же, что помимо любительского использования, часто имеет место более агрессивная, спортивная эксплуатация. Во всех случаях мы имеем понимание правильного подхода к ремонту.</p>
    </div>
    <div style="clear: both"></div>
    <div class="row" >
        <img src="/images/home/qOzSnRSWn5A.jpg" class="col-sm-6 no-padding" style="float: right;">
        <p style="float: left;text-align: center;" class="col-sm-6 no-padding"><br class="hidden-xs"><br class="hidden-xs"><br class="hidden-xs">Мы стремимся сделать так, чтобы твоё увлечение приносило только положительные эмоции. Экономя твоё время, мы выполним любые виды работ по ремонту и обслуживанию мототехники всех марок и моделей. Не важно будет ли это простое ТО, шиномонтаж, регулировки или полная переборка двигателя, сварочные работы или нестандартный ремонт - мы гарантируем эффективное решение.</p>
    </div>
    <br>
    <div style="clear: both"></div>
    <br>
    <p>Стоимость работ по ремонту или обслуживанию питбайка, мотоцикла или квадроцикла рассчитывается индивидуально. Она может зависеть от модели, состояния и типа техники. Наш сервисный менеджер согласует с Вами точную цену по результатам осмотра, диагностики и дефектовки.</p>





    <div class="tehnika-test-drive">

        <!-- Button trigger modal -->
        <button type="button" style="margin: 0 auto;" class="btn btn-primary btn-xs visible-xs" data-toggle="modal" data-target="#myModal">
            Заказать консультацию
        </button>
        <div style="text-align: center">
        <button type="button" class="btn btn-primary btn-lg hidden-xs" data-toggle="modal" data-target="#myModal">
            Заказать консультацию менеджера
        </button>
            <br><div style="clear: both"></div><br>
            <p>
                Ориентировочные цены на работы:
            </p>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Заказать консультацию менеджера</h4>
                    </div>
                    <form class="contact">
                        <fieldset>
                            <div id="result"></div>
                            <div class="modal-body">
                                <ul class="nav nav-list">
                                    <li class="nav-header">Имя<span style="color:red;">*</span></li>
                                    <li><input title="Имя" class="input-modal" value="" type="text" name="name"></li>
                                    <li class="nav-header">Телефон</li>
                                    <li><input title="Телефон" class="input-modal" value="" type="number" name="phone"></li>
                                    <li class="nav-header">Email<span style="color:red;">*</span></li>
                                    <li><input title="Email" class="input-modal" value="" type="text" name="Email"></li>
                                    <li class="nav-header">Комментарий или вопрос</li>
                                    <li><textarea title="Сообщение" class="input-xlarge" name="sug" rows="3"></textarea></li>
                                    <input value="<?=$name?>" type="hidden" name="bike_name">
                                    <input id="href_bike" value="" type="hidden" name="href">
                                </ul>
                                <div class="img-modal">
                                    <?if (!empty($actualItem['MORE_PHOTO'])) {
                                        foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                                            if ($key == 0) {?>
                                                <img src="<?=$photo['SRC']?>" alt="<?=$alt?>" title="<?=$title?>">
                                            <?}
                                        }
                                    }?>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="background: dodgerblue;" data-dismiss="modal">Закрыть</button>
                        <button type="button" id="submit" class="btn btn-primary">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('button#submit').click(function(){
                $('#href_bike').val(window.location.href);
                $.ajax({
                    type: 'POST',
                    url: '/bitrix/templates/bootstrap_pbl/ajax/zakaz_testdrive/ajax_form_mail.php',
                    data: $('form.contact').serialize(),
                    success: function(msg){
                        $('.modal-body').addClass('hide');
                        $('#result').html(msg);
                    },
                    error: function(){
                        alert('Ошибка 500');
                    }
                });
            });
        });
    </script>



    <br>


    <table class="tb">
        <thead>
        <tr>
            <th class="cantry" style="width: 250px; text-align: left;">
                Наименование&nbsp;
            </th>
            <th colspan="2" class="th_adres" style="width: 250px; text-align: left;">
                Цена
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="cantry">
                <strong>Диагностика и ремонт двигателя</strong>
            </td>
            <td colspan="2" class="th_adres">
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Переборка двигателя - Полная<br>
            </td>
            <td colspan="2" class="th_adres">
                6600р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Переборка двигателя - Частичная
            </td>
            <td colspan="2" class="th_adres">
                1100р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Правая крышка двигателя с/у<br>
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Регулировка зазора клапана (1шт)
            </td>
            <td colspan="2" class="th_adres">
                450р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Регулировка зазоров клапанов 4-х кл.ГБЦ
            </td>
            <td colspan="2" class="th_adres">
                1900р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                ЦПГ с/у<br>
            </td>
            <td colspan="2" class="th_adres">
                3300р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                ГБЦ 2V переборка полная
            </td>
            <td colspan="2" class="th_adres">
                1350р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                ГБЦ 4V переборка полная
            </td>
            <td colspan="2" class="th_adres">
                1750р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                ГБЦ 4V переборка полная (с подбором шайб)
            </td>
            <td colspan="2" class="th_adres">
                1950р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Центрифуга масляная с/у
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                ГБЦ с/у
            </td>
            <td colspan="2" class="th_adres">
                1760р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Двигатель с/у
            </td>
            <td colspan="2" class="th_adres">
                2200р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Генератор с/у
            </td>
            <td colspan="2" class="th_adres">
                880р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Сальник генератора - Замена
            </td>
            <td colspan="2" class="th_adres">
                600р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Сальник вала выбора передач &nbsp;- Замена
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Сальник кикстартера &nbsp;- Замена
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Шестерни кикстартера - Замена <br>
            </td>
            <td colspan="2" class="th_adres">
                1350р. &nbsp;
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Корзина сцепления с/у
            </td>
            <td colspan="2" class="th_adres">
                1100р. &nbsp;
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <strong>Техническое обслуживание и регулировка двигателя</strong>
            </td>
            <td colspan="2" class="th_adres">
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Замена масла ДВС
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Регулировка зазора клапана (1шт)
            </td>
            <td colspan="2" class="th_adres">
                450р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Регулировка зазоров клапанов 4V ГБЦ
            </td>
            <td colspan="2" class="th_adres">
                1900р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Выставление меток фаз ГРМ
            </td>
            <td colspan="2" class="th_adres">
                450р. &nbsp;
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Свеча зажигания. Замена
            </td>
            <td colspan="2" class="th_adres">
                100р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <strong>Колеса и шиномонтаж</strong>
            </td>
            <td colspan="2" class="th_adres">
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Колесо с/у (1шт)
            </td>
            <td colspan="2" class="th_adres">
                220р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Колесо - Подкачка
            </td>
            <td colspan="2" class="th_adres">
                25р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Колесо - Исправление восьмерки
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Колесо - Ошиповка (Kold Kutter)
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Переспицовка колеса - Полная
            </td>
            <td colspan="2" class="th_adres">
                1100р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Подшипник ступицы колеса - Замена
            </td>
            <td colspan="2" class="th_adres">
                220р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Протяжка спиц колеса
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Спица колеса - Замена (при снятой покрышке)
            </td>
            <td colspan="2" class="th_adres">
                60р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Шиномонтаж (бескамерная шина)
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Шиномонтаж (спицованный обод)
            </td>
            <td colspan="2" class="th_adres">
                600р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <strong>Подвеска</strong>
            </td>
            <td colspan="2" class="th_adres">
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Амортизатор с/у
            </td>
            <td colspan="2" class="th_adres">
                440р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Амортизатор стандартный - Переборка
            </td>
            <td colspan="2" class="th_adres">
                880р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Амортизатор с расширительным баллоном - Переборка
            </td>
            <td colspan="2" class="th_adres">
                3500р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Амортизатор - Замена масла
            </td>
            <td colspan="2" class="th_adres">
                660р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Амортизатор - Закачка сжатым воздухом
            </td>
            <td colspan="2" class="th_adres">
                300р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Вилка (перья комплект) с/у
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Замена масла в вилке (в т.ч. с/у)
            </td>
            <td colspan="2" class="th_adres">
                1650р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Сальники и пыльники &nbsp;вилки к-т -Замена
            </td>
            <td colspan="2" class="th_adres">
                1450р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <strong>Тормоза</strong>
            </td>
            <td colspan="2" class="th_adres">
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Прокачка контура тормозной системы
            </td>
            <td colspan="2" class="th_adres">
                450р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Тормозной диск - с/у
            </td>
            <td colspan="2" class="th_adres">
                660р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Тормозные колодки - Замена
            </td>
            <td colspan="2" class="th_adres">
                380р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Тормозная машинка с/у (без прокачки контура)
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Кронштейн тормозного суппорта с/у
            </td>
            <td colspan="2" class="th_adres">
                310р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Суппорт тормозной передний с/у
            </td>
            <td colspan="2" class="th_adres">
                660р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Суппорт тормозной задний с/у
            </td>
            <td colspan="2" class="th_adres">
                660р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Тормозной шланг задний с/у (без прокачки контура)
            </td>
            <td colspan="2" class="th_adres">
                250р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Тормозной шланг передний с/у (без прокачки контура)
            </td>
            <td colspan="2" class="th_adres">
                250р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <strong><strong>Топливная система, фильтры</strong></strong>
            </td>
            <td colspan="2" class="th_adres">
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Бак топливный с/у
            </td>
            <td colspan="2" class="th_adres">
                280р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Карбюратор - Регулировка
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Карбюратор - Чистка
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Карбюратор с/у
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Фильтр топливный - Замена
            </td>
            <td colspan="2" class="th_adres">
                110р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Фильтр воздушный с/у&nbsp;(при чистке карбюратора бесплатно)
            </td>
            <td colspan="2" class="th_adres">
                80р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Фильтр воздушный чистка (в том числе с/у)
            </td>
            <td ccolspan="2" class="th_adres">
                150р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Фильтр воздушный пропитка
            </td>
            <td colspan="2" class="th_adres">
                80р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <strong>Привод</strong>
            </td>
            <td colspan="2" class="th_adres">
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ведущая звезда привода с/у
            </td>
            <td colspan="2" class="th_adres">
                280р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ведомая звезда привода с/у
            </td>
            <td colspan="2" class="th_adres">
                300р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Цепь приводная с/у
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Цепь приводная натяжка
            </td>
            <td colspan="2" class="th_adres">
                200р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Цепь приводная - Укорачивание
            </td>
            <td colspan="2" class="th_adres">
                220р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Цепь приводная - Смазка (в том числе промывка)
            </td>
            <td colspan="2" class="th_adres">
                350р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <strong>Дополнительное оборудование&nbsp;</strong>
            </td>
            <td colspan="2" class="th_adres">
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Защита рук - Установка
            </td>
            <td colspan="2" class="th_adres">
                440р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Счетчик моточасов - Установка
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <b>Рама, выхлоп, навесное</b>
            </td>
            <td colspan="2" class="th_adres">
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Протяжка питбайка полная (в том числе протяжка спиц)
            </td>
            <td colspan="2" class="th_adres">
                1100р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Втулки маятника - Замена
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Глушитель с/у
            </td>
            <td colspan="2" class="th_adres">
                220р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Глушитель - Ремонт (клепка)
            </td>
            <td colspan="2" class="th_adres">
                440р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Выхлопная система в сборе с/у
            </td>
            <td colspan="2" class="th_adres">
                400р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Кронштейн подножек с/у
            </td>
            <td colspan="2" class="th_adres">
                550р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Маятник с/у
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ось маятника с/у
            </td>
            <td colspan="2" class="th_adres">
                220р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Пластик 1 элемент с/у
            </td>
            <td colspan="2" class="th_adres">
                60р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Подшипники маятника - Замена
            </td>
            <td colspan="2" class="th_adres">
                550р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Рама- замена
            </td>
            <td colspan="2" class="th_adres">
                6000р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Центровка положения двигателя в раме
            </td>
            <td colspan="2" class="th_adres">
                400р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Шланг радиатора. Замена 1шт
            </td>
            <td colspan="2" class="th_adres">
                220р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <b>Управление</b>
            </td>
            <td colspan="2" class="th_adres">
                <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Грипсы - Замена
            </td>
            <td colspan="2" class="th_adres">
                220р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Кикстартер рычаг с/у
            </td>
            <td colspan="2" class="th_adres">
                110р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ножка переключения передач с/у
            </td>
            <td colspan="2" class="th_adres">
                110р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Подшипники рулевой колонки - Регулировка
            </td>
            <td colspan="2" class="th_adres">
                300р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Руль с/у
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ручка газа с/у
            </td>
            <td colspan="2" class="th_adres">
                220р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ручка газа - Ремонт
            </td>
            <td colspan="2" class="th_adres">
                220р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ручка сцепления с/у
            </td>
            <td colspan="2" class="th_adres">
                180р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ручка тормоза с/у
            </td>
            <td colspan="2" class="th_adres">
                100р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Стойки руля с/у
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Трос газа - Замена
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Трос газа - Смазка
            </td>
            <td colspan="2" class="th_adres">
                180р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Трос сцепления - Замена
            </td>
            <td colspan="2" class="th_adres">
                330р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Трос сцепления - Смазка
            </td>
            <td colspan="2" class="th_adres">
                180р.
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <b>Восстановление резьбы (технология&nbsp;HELICOIL FREERUNNING)</b>
            </td>
            <td colspan="2" class="th_adres">
                <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Восстановление резьбы М6 (без учета с/у детали)
            </td>
            <td colspan="2" class="th_adres">
                450р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Восстановление резьбы М8 (без учета с/у детали)
            </td>
            <td colspan="2" class="th_adres">
                520р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Восстановление резьбы под свечу в ГБЦ 4V М8х1 (без учета с/у детали)
            </td>
            <td colspan="2" class="th_adres">
                840р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Восстановление резьбы под свечу в ГБЦ 2V М10х1 (без учета с/у детали)
            </td>
            <td colspan="2" class="th_adres">
                880р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Восстановление резьбы сливной пробки картера М12х1,5 (без учета с/у детали)
            </td>
            <td colspan="2" class="th_adres">
                899р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Восстановление резьбы сливной пробки картера М14х1,5 (без учета с/у детали)
            </td>
            <td colspan="2" class="th_adres">
                920р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                <b>Ненормированные и прочие работы</b>
            </td>
            <td colspan="2" class="th_adres">
                <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Осмотр техники, диагностика неисправности при последующем ремонте в нашем сервисе
            </td>
            <td colspan="2" class="th_adres">
                Бесплатно&nbsp;<br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Осмотр техники, диагностика неисправности без последующего ремонта
            </td>
            <td colspan="2" class="th_adres">
                от 550р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ненормированные работы Механика (руб/час)
            </td>
            <td colspan="2" class="th_adres">
                850р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Ненормированные работы Электрика (руб/час)
            </td>
            <td colspan="2" class="th_adres">
                850р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Мойка питбайка техническая
            </td>
            <td colspan="2" class="th_adres">
                300р. <br>
            </td>
        </tr>
        <tr>
            <td class="cantry">
                Слесарные работы (сварка, выпрямление, нестандартные работы) руб/час
            </td>
            <td colspan="2" class="th_adres">
                850р. <br>
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <button type="button" style="margin: 0 auto;" class="btn btn-primary btn-xs visible-xs" data-toggle="modal" data-target="#myModal">
        записаться на ремонт
    </button>
    <button style="float:right;" type="button" class="btn btn-primary btn-lg hidden-xs" data-toggle="modal" data-target="#myModal">
        записаться на ремонт
    </button>
    <br>
    <p>
        Настройка,сборка, ремонт, сварка, регулировка, шиномонтаж и другие услуги в нашем сервисе по адресу:<br> <a href="/about/contacts/"><b>ТЦ ФОРМУЛА Х, 2 этаж. 27-й км МКАД внешняя сторона (пересечение МКАД и М4)</b></a>
    </p>
    <p>
        Питбайкленд - профессиональный  сервис, выполняющий любые виды работ по ремонту и обслуживанию питбайков, мотоциклов и квадроциклов всех марок и моделей.
    </p>
    </p><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>