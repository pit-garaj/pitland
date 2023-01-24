<?
$bUseMap = CNext::GetFrontParametrValue('CONTACTS_USE_MAP', SITE_ID) != 'N';
$bUseFeedback = CNext::GetFrontParametrValue('CONTACTS_USE_FEEDBACK', SITE_ID) != 'N';
?>
<?if($bUseMap):?>
	<div class="contacts-page-map">
		<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-map.php", Array(), Array("MODE" => "html", "TEMPLATE" => "include_area.php", "NAME" => "Карта"));?>
	</div>
<?endif;?>

<div class="contacts contacts-page-map-overlay maxwidth-theme" itemscope itemtype="http://schema.org/Organization">
	<div class="contacts-wrapper">
		<div class="row">
			<div class="col-md-3 col-sm-3 print-6">
				<table cellpadding="0" cellspasing="0">
					<tr>
						<td align="left" valign="top"><i class="fa big-icon s45 fa-map-marker"></i></td><td align="left" valign="top"><span class="dark_table">Адрес</span>
							<br />
							<span itemprop="address"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-address.php", Array(), Array("MODE" => "html", "NAME" => "Address"));?></span>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-4 col-sm-4 print-6">
				<table cellpadding="0" cellspasing="0">
					<tr>
						<td align="left" valign="top"><i class="fa big-icon s45 fa-phone"></i></td><td align="left" valign="top"> <span class="dark_table">Телефон</span>
							<br />
							<span itemprop="telephone"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-phone.php", Array(), Array("MODE" => "html", "NAME" => "Phone"));?></span>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-2 col-sm-2 print-6">
				<table cellpadding="0" cellspasing="0">
					<tr>
						<td align="left" valign="top"><i class="fa big-icon s45 fa-envelope"></i></td><td align="left" valign="top"> <span class="dark_table">E-mail</span>
							<br />
							<span itemprop="email"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-email.php", Array(), Array("MODE" => "html", "NAME" => "Email"));?></span>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-3 col-sm-3 print-6">
				<table cellpadding="0" cellspasing="0">
					<tr>
						<td align="left" valign="top"><i class="fa big-icon s45 fa-clock-o"></i></td><td align="left" valign="top"> <span class="dark_table">Режим работы</span>
							<br />
							<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-schedule.php", Array(), Array("MODE" => "html", "NAME" => "Schedule"));?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
