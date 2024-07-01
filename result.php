<? 

require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php');

if (($_POST["size"]) == 'Другое')
{
	$arrFields = [
				'PRODUCT'    => sanitizeString($_POST['products']),
				'SIZE'   => sanitizeString($_POST['size-another']),
				'PAYMENT'   => sanitizeString($_POST['payment']),
				'DELIVERY' => sanitizeString($_POST['delivery']),
				'ADDRESS' => sanitizeString($_POST['address']),
				'PHONE' => sanitizeString($_POST['phone'])
			];
			if(CEvent::Send('FORM_SENDING', 's1', $arrFields, 'N')){
				echo <<<_END
					<div class = "title title-result">
						<img src="/images/forms/form.1/mark.png" class="img-result" alt="result">
						<div>
							Заявка успешно отправлена! Мы скоро свяжемся с вами.
						</div>    
					</div>
				_END;
				CModule::IncludeModule("form");
				$FORM_ID = 13;
				$arValues = array (
					"form_text_88"	=> sanitizeString($_POST['products']),
					"form_text_89" 	=> sanitizeString($_POST['size-another']),
					"form_text_90"	=> sanitizeString($_POST['payment']),
					"form_text_91"	=> sanitizeString($_POST['delivery']),
					"form_text_92"	=> sanitizeString($_POST['address']),
					"form_text_93"	=> sanitizeString($_POST['phone'])
				);
				CFormResult::Add($FORM_ID, $arValues);
			}
}
else {
	$arrFields = [
			'PRODUCT'    => sanitizeString($_POST['products']),
			'SIZE'   => sanitizeString($_POST['size']),
			'PAYMENT'   => sanitizeString($_POST['payment']),
			'DELIVERY' => sanitizeString($_POST['delivery']),
			'ADDRESS' => sanitizeString($_POST['address']),
			'PHONE' => sanitizeString($_POST['phone'])
		];
		if(CEvent::Send('FORM_SENDING', 's1', $arrFields, 'N')){
			echo <<<_END
				<div class = "title title-result">
					<img src="/images/forms/form.1/mark.png" class="img-result">
					<div>
						Заявка успешно отправлена! Мы скоро свяжемся с вами.
					</div>    
				</div>
			_END;
			CModule::IncludeModule("form");
			$FORM_ID = 13;
			$arValues = array (
				"form_text_88"	=> sanitizeString($_POST['products']),
				"form_text_89" 	=> sanitizeString($_POST['size']),
				"form_text_90"	=> sanitizeString($_POST['payment']),
				"form_text_91"	=> sanitizeString($_POST['delivery']),
				"form_text_92"	=> sanitizeString($_POST['address']),
				"form_text_93"	=> sanitizeString($_POST['phone'])
			);
			CFormResult::Add($FORM_ID, $arValues);
		}
}

function sanitizeString($var)
{
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var); 
	return $var;
}
