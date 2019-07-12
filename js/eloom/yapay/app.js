if (typeof($j) == "undefined") {
	$j = jQuery;
}
var Eloom = Eloom || {};
Eloom.Yapay = {
  config: null,
  init: function () {
    if (this.config == null) {
      return;
    }
  },

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
      $j('#p_method_' + Eloom.Yapay.PaymentBoleto.config.code).after('<img src="' + Eloom.Yapay.config.logo + '">');
      if (payment.currentMethod === Eloom.Yapay.PaymentBoleto.config.code) {
        $j('#p_method_' + Eloom.Yapay.PaymentBoleto.config.code).click();
	      Eloom.Yapay.FingerPrint.add(Eloom.Yapay.PaymentBoleto.config.code);
      }

	    this._bindPaymentOption();
    },

	  _bindPaymentOption: function () {
		  $j('#p_method_' + Eloom.Yapay.PaymentBoleto.config.code).on('click', function () {
			  Eloom.Yapay.FingerPrint.add(Eloom.Yapay.PaymentBoleto.config.code);
		  });
	  }
  },
  PaymentCc: {
    config: null,
    init: function () {
      if (this.config == null) {
        return;
      }
      $j('#p_method_' + Eloom.Yapay.PaymentCc.config.code).after('<img src="' + Eloom.Yapay.config.logo + '">');
      if (payment.currentMethod === Eloom.Yapay.PaymentCc.config.code) {
        $j('#p_method_' + Eloom.Yapay.PaymentCc.config.code).click();
	      Eloom.Yapay.FingerPrint.add(Eloom.Yapay.PaymentCc.config.code);
      }

      this._bindPaymentOption();
      this._bindCreditCardAssistance();
      this._bindCustomerInformation();
      this._bindYapayBehavior();
    },

    _bindYapayBehavior: function () {
      $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-number').on('blur', function (event) {
        var value = $j(this).val().replace(/\D/g, '');
        var cardType = '';

				cardType = $j.payment.cardType(value);

        if (cardType.indexOf('Tipo') === -1) {
          $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-type').val(cardType);
          $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-owner').focus();

          $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-number').css('background-image', 'url("' + Eloom.YapayCardTypes.getPath(cardType) + '")');

          var installmentsBox = $j('#' + Eloom.Yapay.PaymentCc.config.code + '-installments');
          installmentsBox.empty();

          var installmentsUrl = Eloom.Yapay.config.installmentsUrl;
          jQuery.ajax({
						dataType: 'json',
            method: 'POST',
            data: {amount: Eloom.Yapay.PaymentCc.config.amount, paymentMethod: cardType},
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
									installmentAmountOriginal = Eloom.Yapay.PaymentCc.config.firstInstallmentAmount;
									installmentAmount = numeral(Eloom.Yapay.PaymentCc.config.firstInstallmentAmount).format('0,0.00');
									totalAmount = numeral(Eloom.Yapay.PaymentCc.config.firstInstallmentAmount).format('0,0.00');
								} else {
									if(installment > Eloom.Yapay.PaymentCc.config.totalInstallmens) {
										return true;
									}
									if (Eloom.Yapay.PaymentCc.config.minInstallment > 0) {
										if (installmentAmount < Eloom.Yapay.PaymentCc.config.minInstallment) {
											return true;
										}
									}
									installmentAmountOriginal = element.SplitValue;
									installmentAmount = numeral(element.SplitValue).format('0,0.00');
									totalAmount = numeral(element.TransactionValue).format('0,0.00');
								}

								text = installment + 'x de R$ '.concat(installmentAmount).concat(' = R$ ' + totalAmount).concat((installment === 1 && Eloom.Yapay.PaymentCc.config.percentualDiscount > 0 ? ' (' + numeral(Eloom.Yapay.PaymentCc.config.percentualDiscount).format('0,0.00') + '% off)' : '')).concat(interest > 0 ? ' c/ juros' : '');
								value = installment + '-' + installmentAmountOriginal;

								installmentsBox.append($j('<option />').text(text).val(value));
							});
							installmentsBox.change(function () {
								payment.update();
							});
							payment.update();
						} else {
							alert(response.message);
						}
          });
        }
      });
    }
    ,
    _bindCustomerInformation: function () {
      $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-holder-another').on('click', function () {
        var elements = $j('#payment_form_' + Eloom.Yapay.PaymentCc.config.code + ' li.yapay-cc-holder');
        if (elements.hasClass('open')) {
          elements.slideToggle().removeClass('open');
          $j('#payment_form_' + Eloom.Yapay.PaymentCc.config.code + ' li.yapay-cc-holder input[type="text"]').removeClass('required-entry');
        } else {
          elements.slideToggle().addClass('open');
          $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-holder-cpf').focus();
          $j('#payment_form_' + Eloom.Yapay.PaymentCc.config.code + ' li.yapay-cc-holder input[type="text"]').addClass('required-entry');
        }
      });
    }
    ,
    _bindPaymentOption: function () {
      $j('#p_method_' + Eloom.Yapay.PaymentCc.config.code).on('click', function () {
        $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-number').focus();
	      Eloom.Yapay.FingerPrint.add(Eloom.Yapay.PaymentCc.config.code);
      });
    },

    _bindCreditCardAssistance: function () {
      $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-number').payment('formatCardNumber');
      $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-expiry').payment('formatCardExpiry');
      $j('#' + Eloom.Yapay.PaymentCc.config.code + '-yapay-cc-cvc').payment('formatCardCVC');
    }
  },

  Errors: {
    config: null,
    init: function () {
      if (this.config == null) {
        return;
      }
    },

    getError: function (response) {
      var m = null;
      try {
        var key = null;
        $j(response.errors).each(function (index, element) {
          for (var k in element) {
            if (!element.hasOwnProperty(k)) {
              continue;
            }
            key = k;
          }
        });
        m = Eloom.Yapay.Errors.config[key].message;
      } catch (exception) {
        m = Eloom.Yapay.Errors.config[-999].message;
      }

      return m;
    }
  }
};

Eloom.YapayCardTypes = {
	path: null,
	url: [],
	cardTypes: ['visa', 'master', 'mastercard', 'amex', 'aura', 'diners', 'elo', 'hipercard', 'jcb'],

	init: function (opt) {
		this.path = opt.mediaUrl + 'idecheckoutvm/payment/';
		jQuery(this.cardTypes).each(function (index, element) {
			Eloom.YapayCardTypes.url[element] = Eloom.YapayCardTypes.path + element + '.png';
		});
	},

	getPath: function (cardType) {
		cardType = cardType.toLowerCase();
		return Eloom.YapayCardTypes.url[cardType];
	}
}