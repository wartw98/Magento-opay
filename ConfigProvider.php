<?php
namespace Dfe\AllPay;
use Df\Payment\ConfigProvider\IOptions;

final class ConfigProvider extends \Df\Payment\ConfigProvider  implements IOptions {
	
	function options() {return $this->s()->options()->o(true);}

	
	protected function config() {return [
		'currencyRateFromBaseToCurrent' => df_currency_rate_to_current()
		,'installment' => ['plans' => $this->s()->installmentSales()->plans()->a()]
	] + self::configOptions($this) + parent::config();}
}