<?php
namespace Dfe\AllPay\Block;
use Dfe\AllPay\Method;
use Dfe\AllPay\W\Event;
use Magento\Sales\Model\Order\Payment\Transaction as T;

class Info extends \Df\Payment\Block\Info {
	
	protected function custom() {return [];}

	
	final protected function prepare() {
		$this->si($this->custom());
		$this->siEx([
			'allPay Payment ID' => $this->e()->idE(), 'Magento Payment ID' => $this->e('MerchantTradeNo')
		]);
	}

	
	protected function prepareDic() {$this->dic()->add('Payment Option', $this->choiceT(), -10);}
}