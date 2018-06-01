<?php
namespace Dfe\AllPay\InstallmentSales;
use Df\Config\A;
use Dfe\AllPay\InstallmentSales\Plan\Entity as Plan;
final class Settings extends \Df\Config\Settings {
	function plans($numPayments = null) {
		$r = $this->_a(Plan::class); 
		return is_null($numPayments) ? $r : $r->get(intval($numPayments));
	}

	protected function prefix() {return 'df_payment/all_pay/installment_sales';}
}