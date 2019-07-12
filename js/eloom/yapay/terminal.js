var EloomPayment = Class.create();
EloomPayment.prototype = {
	initialize: function (form, savePayment) {
		this.form = form;
		this.savePayment = savePayment;
	},
	init: function () {
		var elements = Form.getElements(this.form);
		var method = null;
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].name == 'payment[method]') {
				if (elements[i].checked) {
					method = elements[i].value;
				}
			}
			elements[i].setAttribute('autocomplete', 'off');
		}
		if (method) {
			this.switchMethod(method);
		}
	},
	switchMethod: function (method) {
		if (this.currentMethod && $('payment_form_' + this.currentMethod)) {
			this.changeVisible(this.currentMethod, true);
			$('payment_form_' + this.currentMethod).fire('payment-method:switched-off', {
				method_code: this.currentMethod
			});
		}
		if ($('payment_form_' + method)) {
			this.changeVisible(method, false);
			$('payment_form_' + method).fire('payment-method:switched', {
				method_code: method
			});
		} else {
			document.body.fire('payment-method:switched', {
				method_code: method
			});
		}
		if (method) {
			this.lastUsedMethod = method;
		}
		this.currentMethod = method;
	},
	changeVisible: function (method, mode) {
		var block = 'payment_form_' + method;
		[block + '_before', block, block + '_after'].each(function (el) {
			var element = $(el);
			if (element) {
				element.style.display = (mode) ? 'none' : '';
				element.select('input', 'select', 'textarea', 'button').each(function (field) {
					field.disabled = mode;
				});
				$('messages-yapay').down('li').removeClassName('notice-msg').removeClassName('success-msg').innerHTML = '';
			}
		});
	},
	validate: function () {
		if ($$('[name="payment[method]"]:checked').length == 0) {
			alert(Translator.translate('Please specify payment method.').stripTags());
			return false;
		}

		var methods = document.getElementsByName('payment[method]');
		if (methods.length == 0) {
			alert(Translator.translate('Your order cannot be completed at this time as there is no payment methods available for it.').stripTags());
			return false;
		}

		return true;
	},
	save: function (btn) {
		var validator = new Validation(this.form);
		if (!validator.validate()) {
			return false;
		}
		if (!payment.validate()) {
			return false;
		}
		validator.reset();

		$(btn).disable().next().show();

		var params = Form.serialize(this.form);
		var request = new Ajax.Request(
			this.savePayment, {
				asynchronous: true,
				method: 'post',
				parameters: params,
				onSuccess: this.nextStep.bindAsEventListener(this),
				onComplete: setTimeout(function() {
					$(btn).next().hide();
				}, 5000)
			});
	},
	nextStep: function (transport) {
		var response = null;
		if (transport && transport.responseText) {
			try {
				response = eval('(' + transport.responseText + ')');
			} catch (e) {
				response = {};
			}
		}
		if (response.error) {
			$('messages-yapay').down('li').addClassName('notice-msg').innerHTML = response.error;
		} else {
			$('messages-yapay').down('li').addClassName('success-msg').innerHTML = response.message;
			$('co-payment-form').down('fieldset').hide();
		}
		$('messages-yapay').show();
	}
};

Eloom.Yapay.Terminal = {
	config: null,

	FingerPrint: {
		init: function () {

		},
		add: function (paymentMethod) {
			var attr = jQuery('#ide-checkout-form').attr('data-yapay');
			if (attr === undefined) {
				$j('#ide-checkout-form').attr('data-yapay', 'payment-form');
				$j(document).FingerPrint().getFingerPrint();
			}
			window.setTimeout(function() {
				var fingerPrint = document.getElementsByName('finger_print')[0].value;
				$j('#' + paymentMethod + '-yapay-finger-print').val(fingerPrint);
			}, 3000);
		},
		reset: function () {
			$j('#ide-checkout-form').removeAttr('data-yapay');
		}
	},

	PaymentBoleto: {
		config: null,
		init: function () {
			if (this.config == null) {
				return;
			}
			$j('#p_method_' + Eloom.Yapay.Terminal.PaymentBoleto.config.code).after('<img src="' + Eloom.Yapay.config.logo + '">');
			if (payment.currentMethod === Eloom.Yapay.Terminal.PaymentBoleto.config.code) {
				$j('#p_method_' + Eloom.Yapay.Terminal.PaymentBoleto.config.code).click();
				Eloom.Yapay.Terminal.FingerPrint.add(Eloom.Yapay.Terminal.PaymentBoleto.config.code);
			}

			this._bindPaymentOption();
		},

		_bindPaymentOption: function () {
			$j('#p_method_' + Eloom.Yapay.Terminal.PaymentBoleto.config.code).on('click', function () {
				Eloom.Yapay.Terminal.FingerPrint.add(Eloom.Yapay.Terminal.PaymentBoleto.config.code);
			});
		}
	},
	PaymentCc: {
		config: null,
		init: function () {
			if (this.config == null) {
				return;
			}
			$j('#p_method_' + Eloom.Yapay.Terminal.PaymentCc.config.code).after('<img src="' + Eloom.Yapay.config.logo + '">');
			if (payment.currentMethod === Eloom.Yapay.Terminal.PaymentCc.config.code) {
				$j('#p_method_' + Eloom.Yapay.Terminal.PaymentCc.config.code).click();
				Eloom.Yapay.Terminal.FingerPrint.add(Eloom.Yapay.Terminal.PaymentCc.config.code);
			}

			this._bindPaymentOption();
			this._bindCreditCardAssistance();
			this._bindCustomerInformation();
			this._bindYapayBehavior();
		},

		_bindYapayBehavior: function () {
			$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-number').on('blur', function (event) {
				var value = $j(this).val().replace(/\D/g, '');
				var cardType = '';

				cardType = $j.payment.cardType(value);

				if (cardType.indexOf('Tipo') === -1) {
					$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-type').val(cardType);
					$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-owner').focus();

					$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-number').css('background-image', 'url("' + Eloom.YapayCardTypes.getPath(cardType) + '")');

					var installmentsBox = $j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-installments');
					installmentsBox.empty();

					var installmentsUrl = Eloom.Yapay.config.installmentsUrl;
					jQuery.ajax({
						dataType: 'json',
						method: 'POST',
						data: {amount: Eloom.Yapay.Terminal.PaymentCc.config.amount, paymentMethod: cardType},
						url: installmentsUrl,
						context: document.body
					}).done(function (response) {
						var installments = response.installments;
						var installmentAmount = null;
						var installmentAmountOriginal = null;
						var text = null;
						var totalAmount = null;
						var interest = 0;
						var installment = 0;

						if(response.success) {
							$j(installments).each(function (index, element) {
								installment = parseInt(element.Split);
								interest = element.SplitRate;

								if (installment === 1) {
									installmentAmountOriginal = Eloom.Yapay.Terminal.PaymentCc.config.firstInstallmentAmount;
									installmentAmount = numeral(Eloom.Yapay.Terminal.PaymentCc.config.firstInstallmentAmount).format('0,0.00');
									totalAmount = numeral(Eloom.Yapay.Terminal.PaymentCc.config.firstInstallmentAmount).format('0,0.00');
								} else {
									if(installment > Eloom.Yapay.Terminal.PaymentCc.config.totalInstallmens) {
										return true;
									}
									if (Eloom.Yapay.Terminal.PaymentCc.config.minInstallment > 0) {
										if (installmentAmount < Eloom.Yapay.Terminal.PaymentCc.config.minInstallment) {
											return true;
										}
									}
									installmentAmountOriginal = element.SplitValue;
									installmentAmount = numeral(element.SplitValue).format('0,0.00');
									totalAmount = numeral(element.TransactionValue).format('0,0.00');
								}

								text = installment + 'x de R$ '.concat(installmentAmount).concat(' = R$ ' + totalAmount).concat((installment === 1 && Eloom.Yapay.Terminal.PaymentCc.config.percentualDiscount > 0 ? ' (' + numeral(Eloom.Yapay.Terminal.PaymentCc.config.percentualDiscount).format('0,0.00') + '% off)' : '')).concat(interest > 0 ? ' c/ juros' : '');
								value = installment + '-' + installmentAmountOriginal;

								installmentsBox.append($j('<option />').text(text).val(value));
							});
						} else {
							alert(response.message);
						}
					});
				}
			});
		}
		,
		_bindCustomerInformation: function () {
			$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-holder-another').on('click', function () {
				var elements = $j('#payment_form_' + Eloom.Yapay.Terminal.PaymentCc.config.code + ' li.yapay-cc-holder');
				if (elements.hasClass('open')) {
					elements.slideToggle().removeClass('open');
					$j('#payment_form_' + Eloom.Yapay.Terminal.PaymentCc.config.code + ' li.yapay-cc-holder input[type="text"]').removeClass('required-entry');
				} else {
					elements.slideToggle().addClass('open');
					$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-holder-cpf').focus();
					$j('#payment_form_' + Eloom.Yapay.Terminal.PaymentCc.config.code + ' li.yapay-cc-holder input[type="text"]').addClass('required-entry');
				}
			});
		}
		,
		_bindPaymentOption: function () {
			$j('#p_method_' + Eloom.Yapay.Terminal.PaymentCc.config.code).on('click', function () {
				$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-number').focus();
				Eloom.Yapay.Terminal.FingerPrint.add(Eloom.Yapay.Terminal.PaymentCc.config.code);
			});
		},

		_bindCreditCardAssistance: function () {
			$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-number').payment('formatCardNumber');
			$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-expiry').payment('formatCardExpiry');
			$j('#' + Eloom.Yapay.Terminal.PaymentCc.config.code + '-yapay-cc-cvc').payment('formatCardCVC');
		}
	}
};