<?php
define('NINJA_PAGE_LANDING', true);

/** @var object $APPLICATION */

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @var object $APPLICATION */

$APPLICATION->SetPageProperty("HIDE_LEFT_BLOCK", "Y");
$APPLICATION->SetTitle("Приглашаем тебя в Мир Питбайков - PitbikeLand!");
$APPLICATION->SetPageProperty('codePage', 'page-about');
?><div class="page-about__container">
	<div class="page-about__header">
		<div class="page-about__name">
			<h1>Ты готов стать частью команды?</h1>
		</div>
		<div class="page-about__desc">
			 Приглашаем тебя в Мир Питбайков - PITLAND!
		</div>
	</div>
	<div class="page-about__row">
		<div class="row">
			<div class="col-md-5">
				<p>
					 Привет! Давай знакомиться, мы&nbsp;— команда сети магазинов PITLAND. Каждый из&nbsp;нас живет мототемой и&nbsp;верит, что сейчас время безграничных возможностей для самореализации. Наше видение, идеи и&nbsp;стремления мы&nbsp;реализовали в&nbsp;этот проект&nbsp;— мир питбайков, магазин мечты&nbsp;— PITLAND.
				</p>
				<p>
					 Создавая PITLAND, мы&nbsp;хотели сделать самый крутой и&nbsp;удобный магазин питбайков в&nbsp;России. Место, где не&nbsp;просто есть все для питбайкера, но&nbsp;и&nbsp;куда нам самим было&nbsp;бы приятно приходить каждый день. На&nbsp;работу нашей мечты, в&nbsp;идеальный магазин питбайков.
				</p>
			</div>
			<div class="col-md-7"><img src="/local/build/img/pages/about/001.jpg" class="img-rounded img-responsive"></div>
		</div>
	</div>
	<div class="page-about__row page-about__row--reorder">
		<div class="row">
			<div class="col-md-5"><img src="/local/build/img/pages/about/002.jpg" class="img-rounded img-responsive"></div>
			<div class="col-md-7">
				<div class="page-about__block-title">
					 Магазин «Формула-Х»
				</div>
				<p>
					 Что-то купить и&nbsp;пообщаться, решить свои проблемы с&nbsp;техникой, узнать новости и&nbsp;«позалипать» на&nbsp;новый экип или видео на&nbsp;мониторах. Важен не&nbsp;только бизнес, но&nbsp;и&nbsp;атмосфера места, мнение и&nbsp;настроение наших клиентов. Поэтому у&nbsp;нас есть собственная трасса для тест-драйва. И&nbsp;самое главное&nbsp;— мы&nbsp;продвигаем тему мотокросса и&nbsp;питбайка в&nbsp;соц-сетях. Ты&nbsp;можешь заценить наш обзор, прокомментировать новый безумный проект, увидеть единомышленников и&nbsp;быть с&nbsp;нами в&nbsp;контакте, разделяя радость от&nbsp;нашего общего хобби.
				</p>
			</div>
		</div>
	</div>
	<div class="page-about__row">
		<div class="row">
			<div class="col-sm-7">
				<div class="page-about__block-title">
					 Магазин «DEXTER»
				</div>
				<p>
					 Нам приятно осознавать, что в&nbsp;стенах нашего шоу рума, среди грубого дерева, хулиганских скетчей на&nbsp;стенах, яркой и&nbsp;четкой экипировки, запчастей и&nbsp;питбайков рождается интерес к&nbsp;нашей теме у&nbsp;начинающих спортсменов. Для тех&nbsp;же, кто давно в&nbsp;теме, наших старых друзей&nbsp;— это атмосферное место, куда они приходят как в&nbsp;любимый бар или гараж.
				</p>
			</div>
			<div class="col-sm-5"><img src="/local/build/img/pages/about/003.jpg" class="img-rounded img-responsive"></div>
		</div>
	</div>
	<div class="page-about__row">
		<div class="row">
      <div class="col-sm-5"><img src="/local/build/img/pages/about/004.jpg" class="img-rounded img-responsive"></div>
			<div class="col-sm-7">
				<div class="page-about__block-title">
					 Сервис
				</div>
				<p>
					 Что такое Моточасы? —&nbsp;мы&nbsp;считаем, что это время, проведенное с&nbsp;удовольствием, а&nbsp;не&nbsp;потраченное на&nbsp;ремонт твоего питбайка или мотоцикла.
				</p>
				<p>
					 Залогом долговечной службы аппарата является его правильное и&nbsp;своевременное обслуживание. Мы&nbsp;сами являемся владельцами мототехники и&nbsp;тестируем все, что продаем и&nbsp;обслуживаем. Это помогает нам эффективнее решать вопросы сервиса, с&nbsp;которыми к&nbsp;нам обращаются клиенты.
				</p>
				<p>
					 Мы&nbsp;стремимся сделать так, чтобы твоё увлечение приносило только положительные эмоции. Экономя твоё время, мы&nbsp;выполним любые виды работ по&nbsp;ремонту и&nbsp;обслуживанию мототехники всех марок и&nbsp;моделей. Не&nbsp;важно, будет&nbsp;ли это простое&nbsp;ТО, шиномонтаж, регулировки или полная переборка двигателя, сварочные работы или нестандартный ремонт&nbsp;— мы&nbsp;гарантируем эффективное решение.
				</p>
			</div>
		</div>
	</div>
	<div class="page-about__feed-back">
		 <?$APPLICATION->IncludeComponent(
	"ninja:feed_back",
	"main",
Array()
);?>
	</div>
	<div class="page-about__row">
		<div class="page-about__block-title">
			 8&nbsp;причин приехать в&nbsp;наши салоны на&nbsp;Юге и&nbsp;Севере Москвы:
		</div>
		<div class="page-about__list">
			<div class="page-about__list-item">
				<div class="page-about__list-icon"><img src="/local/build/img/pages/about/icons/001.jpg" alt=""></div>
				<div class="page-about__list-text">
					 Премия «Лучший Мотосалон Avantis, JMC, BSE». В&nbsp;наличии все модели Питбайков, которые представлены на&nbsp;рынке: <b>Kayo, BSE, JMC, YCF, Apollo, Motoland, Wels, Virus Moto, Racer, Pitrace</b>. Также у&nbsp;нас вы&nbsp;найдете квадроциклы <b>Motax, Avantis</b> и&nbsp;полноразмерные мотоциклы <b>KAYO, BSE, Motoland, Baltmotors</b>. Мы&nbsp;можем дать вам возможность выбрать, а&nbsp;консультация от&nbsp;наших менеджеров сделает этот выбор обоснованным.
				</div>
			</div>
			<div class="page-about__list-item">
				<div class="page-about__list-icon"><img src="/local/build/img/pages/about/icons/002.jpg" alt=""></div>
				<div class="page-about__list-text">
					 В&nbsp;нашем магазине огромный выбор экипировки и&nbsp;большой ассортимент запчастей, резины и&nbsp;аксессуаров. Вам не&nbsp;придется ехать в&nbsp;другой магазин, вы&nbsp;купите все в&nbsp;одном месте.
				</div>
			</div>
			<div class="page-about__list-item">
				<div class="page-about__list-icon"><img src="/local/build/img/pages/about/icons/003.jpg" alt=""></div>
				<div class="page-about__list-text">
					 Мы&nbsp;доставим вам технику по&nbsp;Москве и&nbsp;области, и&nbsp;в&nbsp;любой регион России, и&nbsp;это будет бесплатно<br>
          <sup>*</sup>(<a href="/help/delivery/">есть регионы-исключения</a>)
				</div>
			</div>
      <div class="page-about__list-item">
        <div class="page-about__list-icon"><img src="/local/build/img/pages/about/icons/004.jpg" alt=""></div>
        <div class="page-about__list-text">
          Возможность купить в&nbsp;кредит и&nbsp;в&nbsp;рассрочку, за&nbsp;час, в&nbsp;том числе он-лайн.
        </div>
      </div>
      <div class="page-about__list-item">
        <div class="page-about__list-icon"><img src="/local/build/img/pages/about/icons/009.jpg" alt=""></div>
        <div class="page-about__list-text">
          Есть возможность заказать Премиальную сборку в нашем сервисе
        </div>
      </div>
			<div class="page-about__list-item">
				<div class="page-about__list-icon"><img src="/local/build/img/pages/about/icons/006.jpg" alt=""></div>
				<div class="page-about__list-text">
          <b>PITLAND</b> является авторизированным мотосервисом всех марок, представленных в&nbsp;нашем магазине. Вы&nbsp;сможете делать&nbsp;ТО и&nbsp;любые ремонтные и&nbsp;гарантийные работы. В&nbsp;правильном месте и&nbsp;по&nbsp;приемлемым ценам.
				</div>
			</div>
			<div class="page-about__list-item">
				<div class="page-about__list-icon"><img src="/local/build/img/pages/about/icons/007.jpg" alt=""></div>
				<div class="page-about__list-text">
          <b>Более 1000</b> довольных покупателей.
				</div>
			</div>
			<div class="page-about__list-item">
				<div class="page-about__list-icon"><img src="/local/build/img/pages/about/icons/008.jpg" alt=""></div>
				<div class="page-about__list-text">
          <b>Мы&nbsp;действительно знаем о&nbsp;Питбайках все!</b>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
