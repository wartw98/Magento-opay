<?php
namespace Dfe\AllPay\W;
use Dfe\AllPay\Source\Option;

final class Reader extends \Df\Payment\W\Reader {
	
	function isOffline() {return !in_array($this->t(), [self::BANK_CARD, Option::WEB_ATM]);}

	
	protected function kt() {return 'PaymentType';}

	
	protected function te2i($t) {return dftr(df_first(explode('_', $t)), [
		Option::BANK_CARD => self::BANK_CARD, Option::BARCODE => 'Barcode'
	]);}

	
	const BANK_CARD = 'BankCard';
}