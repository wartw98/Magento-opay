<?php
namespace Dfe\AllPay;
use Dfe\AllPay\Settings as S;

final class Signer extends \Df\PaypalClone\Signer {
	
	protected function sign() {
		$p = $this->v(); 
		
		unset($p['CheckMacValue']);
		
		uksort($p, function($a, $b) {return strcasecmp($a, $b);});
		$s = $this->s(); 
		
		$p = ['HashKey' => $s->hashKey()] + $p + ['HashIV' => $s->hashIV()];
		
		$result = implode('&', df_map_k($p, function($k, $v) {return implode('=', [$k, $v]);}));
		
		$result = strtolower(urlencode($result));
		$result = $this->encodeSpecialChars($result);
		return strtoupper(md5($result));
	}

	
	private function encodeSpecialChars($s) {return strtr($s, [
		'%2d' => '-', '%5f' => '_', '%2e' => '.', '%21' => '!'
		,'%2a' => '*', '%28' => '(', '%29'	=> ')'
	]);}
}