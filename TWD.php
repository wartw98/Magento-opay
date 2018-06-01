<?php
namespace Dfe\AllPay;
final class TWD {
	
	static function from($a, $cCode = null) {return round(df_currency_convert($a, $cCode, 'TWD'));}

	
	static function round($a, $cCode) {return 'TWD' === $cCode ? round($a) : $a;}
}