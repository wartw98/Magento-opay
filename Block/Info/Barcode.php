<?php
namespace Dfe\AllPay\Block\Info;
use Dfe\AllPay\W\Event\Offline as Event;

class Barcode extends Offline {
	
	final protected function paymentId(Event $f) {return df_cc_n($f->r(['Barcode1', 'Barcode2', 'Barcode3']));}

	
	final protected function paymentIdLabel() {return 'Barcode';}
}