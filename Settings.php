<?php

namespace Dfe\AllPay;
use Df\Config\Source\WaitPeriodType;
use Df\Payment\Settings\Options as O;
use Dfe\AllPay\Source\Option as OptionSource;

final class Settings extends \Df\Payment\Settings {
	
	function descriptionOnKiosk() {return $this->v();}

	
	function hashIV() {return $this->testablePV();}

	
	function hashKey() {return $this->testablePV();}

	
	function installmentSales() {return $this->child(InstallmentSales\Settings::class);}

	
	function options() {return $this->_options(OptionSource::class);}

	
	function waitPeriodATM() {return WaitPeriodType::calculate($this);}
}