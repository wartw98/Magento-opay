<?php
namespace Dfe\AllPay\Init;
final class Action extends \Df\PaypalClone\Init\Action {
	protected function redirectUrl() {return 'https://payment{stage}.allpay.com.tw/Cashier/AioCheckOut/V2';}
}