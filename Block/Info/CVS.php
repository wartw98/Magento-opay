<?php
namespace Dfe\AllPay\Block\Info;
use Dfe\AllPay\W\Event\Offline as Event;
class CVS extends Offline {
	final protected function paymentId(Event $f) {return $f->r('PaymentNo');}

	final protected function paymentIdLabel() {return 'Payment Number';}
}