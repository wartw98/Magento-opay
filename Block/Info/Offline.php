<?php
namespace Dfe\AllPay\Block\Info;
use Dfe\AllPay\W\Event\Offline as Event;
use Zend_Date as ZD;
abstract class Offline extends \Dfe\AllPay\Block\Info {
	abstract protected function paymentId(Event $f);

	abstract protected function paymentIdLabel();

	final protected function custom() {
		$ex = $this->extended();
		$result = [];
		if (!($paid = ($f = $this->e()) != ($l = $this->tm()->responseL())) || $ex) {
			$result[$this->paymentIdLabel()] = $this->paymentId($f);
		}
		$result += $paid
			? ['Paid' => $l->paidTime()->toString($ex ? ZD::DATETIME_LONG : ZD::DATE_LONG)]
			: ['Expiration' => $l->expirationS()]
		;
		if ($bankCode = $f->r('BankCode')) {
			$result += ['Bank Code' => $bankCode];
		}
		return $result;
	}

	final protected function prepareUnconfirmed() {$this->prepare();}
}