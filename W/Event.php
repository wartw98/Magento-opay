<?php
namespace Dfe\AllPay\W;
use Dfe\AllPay\Method;
use Zend_Date as ZD;

class Event extends \Df\PaypalClone\W\Event {
	
	final protected function k_idE() {return 'TradeNo';}
	
	
	final protected function k_pid() {return 'MerchantTradeNo';}

	
	final protected function k_signature() {return 'CheckMacValue';}

	
	final protected function k_status() {return 'RtnCode';}

	
	protected function statusExpected() {return 1;}

	
	final protected function tl_($t) {return
		
		2 > count($a = explode('_', df_param_sne($t, 0))) || !($l = $this->tlByCode($f = $a[0], $a[1]))
		? $t : (!in_array($f, ['ATM', 'WebATM']) ? __($l) : df_cc_s(__($f), __($l)))
	;}

	
	protected function tlByCode($f, $l) {return dfa_deep(df_module_json($this, 'labels'), [$f, $l]);}

	
	final protected function useRawTypeForLabel() {return true;}

	
	final protected static function time($timeS) {return dfcf(function($timeS) {return
		!$timeS ? null : df_date_parse($timeS, true, 'y/MM/dd HH:mm:ss', Method::TIMEZONE)
	;}, [$timeS]);}
}