<?php
namespace Dfe\AllPay\W\Event;
use Dfe\AllPay\Charge;
use Dfe\AllPay\Source\Option;
use Zend_Date as ZD;

final class Offline extends \Dfe\AllPay\W\Event {
	
	function expirationS() {return dfc($this, function() {
		
		$result = df_dts($exp = new ZD($this->r('ExpireDate'), 'y/MM/dd'), ZD::DATE_LONG);
		
		$note = 0 > ($d = df_days_left($exp)) ? __('expired') : (
			0 === $d ? __('today') : (1 === $d ? __('1 day left') : __('%1 days left', $d))
		);
		return "{$result} ({$note})";
	});}

	
	function ttCurrent() {return df_action_has(Charge::OFFLINE) ? self::T_INFO : self::T_CAPTURE;}

	
	function paidTime() {return self::time($this->r('PaymentDate'));}

	
	protected function statusExpected() {return
		(self::T_CAPTURE === $this->ttCurrent()) ? parent::statusExpected() : (
			Option::ATM === $this->t() ? 2 : 10100073
		)
	;}
}