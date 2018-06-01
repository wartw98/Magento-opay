<?php
namespace Dfe\AllPay\Source;
final class Option extends \Df\Config\Source {
	protected function map() {return [
		self::BANK_CARD => 'Bank Card'
		
		,self::WEB_ATM => 'Web ATM'
		,self::ATM => 'Physical ATM machine'
		,'CVS' => 'CVS code'
		,self::BARCODE => 'Barcode'
		,'Tenpay' => 'Tenpay (WeChat)'
		,'TopUpUsed' => 'oPay Account'
	];}

	
	const ATM = 'ATM';

	
	const BANK_CARD = 'Credit';
	const BARCODE = 'BARCODE';

	const WEB_ATM = 'WebATM';
}