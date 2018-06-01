<?php
namespace Dfe\AllPay\Block;
use Dfe\AllPay\Total\Quote as TQuote;
class Total extends \Df\Sales\Block\Order\Total {
	
	function initTotals() {
		list($v, $b) = TQuote::iiGet($this->op()); 
		if ($v) {
			$this->addBefore('dfe_allpay', 'Installment Fee', $v, $b, 'grand_total');
		}
	}
}