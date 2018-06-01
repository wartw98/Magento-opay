<?php
namespace Dfe\AllPay\Controller\CustomerReturn;
class Index extends \Df\Payment\CustomerReturn {
	final protected function message() {return df_request('RtnMsg');}
}