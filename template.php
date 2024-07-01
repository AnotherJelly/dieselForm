<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\Core;
use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;

/**
 * @var array $arResult
 */

$request = Core::$app->request;

$this->setFrameMode(true);

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

$arViewParams = ArrayHelper::getValue($arResult, 'VIEW_PARAMETERS');

$sFormBgTheme = $arViewParams['FORM_BACKGROUND'] == 'theme' ? ' intec-cl-background' : null;
$sFromBgCustom = $arViewParams['FORM_BACKGROUND'] == 'custom' ? $arViewParams['FORM_BACKGROUND_CUSTOM'] : null;

$sBgPicture = $arViewParams['BLOCK_BACKGROUND'];

$arBlockBg = [
    'class' => 'main-form'
];
$arFormBg = [
    'class' => 'form-result-new-form-background'.$sFormBgTheme,
    'style' => [
        'background-color' => $sFromBgCustom,
        'opacity' => $arViewParams['FORM_BACKGROUND_OPACITY']
    ]
];


$sRequiredSign = '*';
$sSubmitText = ArrayHelper::getValue($arResult, ['arForm', 'BUTTON']);


?>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</head>

<form action="<?=$templateFolder;?>/result.php" method="POST">
<div id="<?= $sTemplateId ?>">
    <?= Html::beginTag('div', $arBlockBg) ?>
<div class="intec-content">
<div class="intec-content-wrapper">
            <div class="title">
                Калькулятор расчёта топлива
			</div>
                    <div class="form-result-new-form-wrap theme-<?= $arViewParams['FORM_TEXT_COLOR'] ?>">
                        <?= Html::tag('div', '', $arFormBg) ?>
                        <div>
                            <?php { ?>
                                <?= $arResult['FORM_HEADER'] ?>

							<? if ($arResult["isFormErrors"] === "Y") { ?>
								<div class="errors">
									<?=$arResult["FORM_ERRORS_TEXT"]?>
								</div>
							<? } ?>


	<div class="container">
						<div class="container-child" id="container-child-left">
							<!-- Тип продукции -->
							<div class = "main-section">
								<label class = "section-title"> Какая продукция нужна? </label>
								<div class="sections">
									<label>
										<input class="sections-radio-real" type="radio" name="products" id="products" value="ДТ сорт C" checked/>
										<span class="sections-radio-visible">ДТ сорт <b>С</b></span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="products" id="products" value="ДТ сорт E"/>
										<span class="sections-radio-visible">ДТ сорт <b>E</b></span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="products" id="products" value="ДТ сорт F"/>
										<span class="sections-radio-visible">ДТ сорт <b>F</b></span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="products" id="products" value="ДТ зимнее класс 1"/>
										<span class="sections-radio-visible">ДТЗ <b>класс 1</b></span>
									</label>

									<label>
										<input class="sections-radio-real" type="radio" name="products" id="products" value="ДТ зимнее класс 2"/>
										<span class="sections-radio-visible">ДТЗ <b>класс 2</b></span>
									</label>
								</div>
							</div>
						
							<!-- Объём -->
							<div class = "main-section">
								<label class = "section-title"> Укажите объём </label>
								<div class="sections">
									<label>
										<input class="sections-radio-real" type="radio" name="size" value="500" onclick="hide_another()" checked/>
										<span class="sections-radio-visible">500 л</span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="size" value="1000" onclick="hide_another()"/>
										<span class="sections-radio-visible">1 000 л</span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="size" value="3000" onclick="hide_another()"/>
										<span class="sections-radio-visible">3 000 л</span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="size" value="5000" onclick="hide_another()"/>
										<span class="sections-radio-visible">5 000 л</span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="size" value="15000" onclick="hide_another()"/>
										<span class="sections-radio-visible">15 000 л</span>
									</label>

									<label>
										<input class="sections-radio-real" type="radio" name="size" value="30000" onclick="hide_another()"/>
										<span class="sections-radio-visible">30 000 л</span>
									</label>

									<label>
										<input class="sections-radio-real" type="radio" name="size" value="Другое" />
										<span class="sections-radio-visible" id="radio-another">Другое</span>
										<div>
											<input class="text-field-another__input" placeholder="Укажите" id="size-another" type="text" name="size-another">
										</div>
									</label>
	
								</div>
							</div>
	
							<!-- Способ оплаты -->
							<div class = "main-section">
								<label class = "section-title"> Способ оплаты </label>
								<div class="sections">
									<label>
										<input class="sections-radio-real" type="radio" name="payment" value="Наличными" checked/>
										<span class="sections-radio-visible">Наличными</span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="payment" value="Картой"/>
										<span class="sections-radio-visible">Картой</span>
									</label>
	
									<label>
										<input class ="sections-radio-real" type="radio" name="payment" value="Безналичный расчёт"/>
										<span class ="sections-radio-visible" id="cashless_payments">Безналичный расчёт</span>
									</label>
								
								</div>
							</div>
						</div>
	
						<div class = "container-child" id="container-child-right">
							<!-- Тип доставки -->
							<div class = "main-section">
								<label class = "section-title"> Тип доставки <br></label>
								<div class="section-delivery">
									<label>
										<input class="sections-radio-real" type="radio" name="delivery" value="Москва" checked/>
										<span class="sections-radio-visible-delivery">Москва</span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="delivery" value="МО"/>
										<span class="sections-radio-visible-delivery">МО</span>
									</label>
	
									<label>
										<input class="sections-radio-real" type="radio" name="delivery" value="По РФ"/>
										<span class="sections-radio-visible-delivery">По РФ</span>
									</label>
								
								</div>
							</div>
							<div class = "main-section">
								<label class = "section-title" for = "address">Адрес доставки<br></label>
								<input class="intec-ui intec-ui-control-input intec-ui-size-3 intec-ui-mod-round-3 address-input" placeholder="Ул. Ленина, д.25" type="text" id="address" name="address" required>
							</div>
							<div class = "main-section">
								<label class="section-title" for = "phone">Ваш телефон<br></label>	
								<input class="intec-ui intec-ui-control-input intec-ui-size-3 intec-ui-mod-round-3 phone-input" id="text-number__input" placeholder="+7 (___) ___-__-__" type="text" id="phone" name="phone" required>
							</div>

<div class="form-result-new-consent">
                    <label class="intec-ui intec-ui-control-checkbox intec-ui-scheme-current">
                        <input type="checkbox" name="licenses_popup" value="Y" checked="checked" required>                        <span class="intec-ui-part-selector"></span>
                        <span class="form-result-new-consent-text intec-ui-part-content">
                            Я согласен(а) на <a href="/company/consent/" target="_blank">обработку персональных данных</a>                        </span>
                    </label>
                </div>

							<div>
                                    <?= Html::submitButton($sSubmitText, [
                                        'class' => [
                                            'button-apply'
                                        ],
                                        'name' => 'web_form_apply',
                                        'value' => 'Y',
                                        'disabled' => $arResult['F_RIGHT'] < 10 || $arViewParams['CONSENT']['SHOW']
                                    ]) ?>
                                </div>
                                <?= $arResult['FORM_FOOTER'] ?>
                            <?php } ?>
						</div>
					</div>

            </div>
        </div>
	</div>
</div>
    <?= Html::endTag('div') ?>

    <script type="text/javascript">
        template.load(function (data) {
            var $ = this.getLibrary('$');
            var component = {};

            component.form = $('form', data.nodes);
            component.consent = $('[name="licenses_popup"]', component.form);
            component.submit = $('[type="submit"]', component.form);

            if (!component.form.length || !component.consent.length || !component.submit.length)
                return;

            component.handler = {
                'change': function () {
                    component.submit.prop('disabled', !component.consent.prop('checked'));
                },
                'submit': function () {
                    return component.consent.prop('checked');
                }
            };

            component.form.on('submit', component.handler.submit);
            component.consent.on('change', component.handler.change);

            component.handler.change();
        }, {
            'name': '[Component] intec.universe:main.widget (form.1)',
            'nodes': <?= JavaScript::toObject('#'.$sTemplateId) ?>,
            'loader': {
                'name': 'lazy'
            }
        });
    </script>
	<script>
		$(function() {
			 $('#text-number__input').mask('+7 (000) 000-00-00');
		});
	</script>
	<script>
		const radio_another = document.querySelector('#radio-another');
		const size_another = document.querySelector('#size-another');
	
		radio_another.addEventListener('click', () => {
			size_another.classList.add('open');
		});
	</script>
	<script>
		function hide_another() {
			const size_another = document.querySelector('#size-another');
			size_another.classList.remove('open');
			size_another.value = "";
		}
	</script>


</div>
</form>