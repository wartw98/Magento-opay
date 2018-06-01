<?php
namespace Dfe\AllPay\W;
use Dfe\AllPay\Source\Option;

final class F extends \Df\Payment\W\F {
	
	protected function sufEvent($t) {return Option::WEB_ATM === $t ? '' : (
		$this->r()->isOffline() ? 'Offline' : $t
	);}
}