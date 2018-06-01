<?php
namespace Dfe\AllPay\W\Event;
use Dfe\AllPay\Source\Option;
use Zend_Date as ZD;

final class BankCard extends \Dfe\AllPay\W\Event {
	
	function authTime() {return self::time($this->r('process_date'));}

	
	function numPayments() {return intval($this->r('stage'));}

	
	protected function tlByCode($f, $l) {return df_cc_s(
		parent::tlByCode(df_assert_eq(Option::BANK_CARD, $f), $l)
		,!$this->numPayments() ? '' : '(Installments)'
	);}
}