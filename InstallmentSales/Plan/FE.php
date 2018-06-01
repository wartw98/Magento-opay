<?php
namespace Dfe\AllPay\InstallmentSales\Plan;
use Dfe\AllPay\InstallmentSales\Plan\Entity as O;

class FE extends \Df\Framework\Form\Element\Fieldset {
	
	final function onFormInitialized() {
		parent::onFormInitialized();
		$this->addClass('dfe-allpay-installment-plan');
		$this->select2Number(O::numPayments, 'Payments', [3, 6, 12, 18, 24]);
		$this->percent(O::rate, 'Interest Rate');
		$this->money(O::fee, 'Fixed Monthly Fee');
		df_fe_init($this, __CLASS__, [], [], 'plan');
	}
}