<?php
namespace Dfe\AllPay\W;
use Df\Framework\W\Result\Text;

final class Responder extends \Df\Payment\W\Responder {
	
	protected function error($e) {return Text::i('0|' . df_lets($e));}

	
	protected function notForUs($message = null) {return $this->success();}

	
	protected function success() {return Text::i('1|OK');}
}