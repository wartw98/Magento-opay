<?php
namespace Dfe\AllPay\InstallmentSales\Plan;
use Dfe\AllPay\TWD;
use Df\Core\Exception as DFE;
final class Entity extends \Df\Config\ArrayItem {
	
	function amount($a, $cCode) {return !$a ? 0 : TWD::round(
		$a * (1 + $this->rate() / 100) + $this->fee($cCode) * $this->numPayments()
		,$cCode
	);}

	
	function id() {return $this->numPayments();}

	
	function numPayments() {return $this->nat();}

	
	function sortWeight() {return $this->numPayments();}

	
	function validate() {df_assert($this->numPayments());}

	
	private function fee($currencyCode = null) {
		
		$result = $this->f();
		return !$currencyCode ? $result : df_currency_convert($result, null, $currencyCode);
	}

	
	private function rate() {return $this->f();}

	
	const fee = 'fee';
	const numPayments = 'numPayments';
	const rate = 'rate';
}