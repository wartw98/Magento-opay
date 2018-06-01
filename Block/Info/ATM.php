<?php
namespace Dfe\AllPay\Block\Info;
use Dfe\AllPay\W\Event\Offline as Event;

class ATM extends Offline {
	final protected function paymentId(Event $f) {return $f->r('vAccount');}

	
	final protected function paymentIdLabel() {return 'Account Number';}
}