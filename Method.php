<?php
namespace Dfe\AllPay;
use Df\Payment\W\Event;
use Dfe\AllPay\Block\Info;
use Dfe\AllPay\InstallmentSales\Plan\Entity as Plan;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OrderAddress;
use Magento\Sales\Model\Order\Payment as OP;

final class Method extends \Df\PaypalClone\Method {
	
	function getInfoBlockType() { return df_cc_class(
		df_cts(Info::class), ($ev = df_tmf($this)) ? $ev->t() : null
	);}

	
	function option() {return $this->iia(self::$II_OPTION);}

	
	function plan() {return dfc($this, function() { return
		!ctype_digit($id = $this->option()) ? null : $this->s()->installmentSales()->plans($id)
	;});}

	
	protected function amountFactor() {return 1;}

	
	protected function amountLimits() {return [null, 30000];}

	
	protected function iiaKeys() {return [self::$II_OPTION];}

	
	const TIMEZONE = 'Asia/Taipei';

	
	private static $II_OPTION = 'option';
}