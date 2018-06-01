<?php
namespace Dfe\AllPay\Block\Info;
use Dfe\AllPay\InstallmentSales\Plan\Entity as Plan;
use Dfe\AllPay\W\Event\BankCard as Event;

class BankCard extends \Dfe\AllPay\Block\Info {
	
	final protected function custom() {
		$result = []; 
		$result['Card Number'] = df_ccc('******', $this->e('card6no', 'card4no'));
		if ($ex = $this->extended()) {  
			$result['ECI'] = $this->eci();
		}
		$result['Authorization Code'] = $this->e('auth_code');
		if ($ex) {$result += [
			'Authorization Time' => $this->e()->authTime()
			
			,'allPay Authorization Code' => $this->allpayAuthCode()
		];}
		return df_clean($result);
	}

	
	final protected function prepareDic() {
		parent::prepareDic();
		
		if (($e = $this->e()) && ($n = $e->numPayments())) {
			$this->dic()->addAfter('Payment Option', 'Payments', $n);
		}
	}

	
	final protected function prepareUnconfirmed() {
		if ($p = $this->m()->plan()) {
			$this->si('Payments', $p->numPayments());
		}
	}

	
	private function allpayAuthCode() {
		$url = 'http://creditvendor{stage}.allpay.com.tw/DumpAuth/OrderView?TradeID=%d'; /** @var string $url */
		
		return df_tag_ab($gwsr = $this->e('gwsr'), dfp_url_api($this, $url, [], $this->isTest(), $gwsr));
	}

	
	private function eci() {/** @var string|null $eci */return is_null($eci = $this->e('eci')) ? null :
		sprintf("0{$eci} (%s)", dfa([
			0 => 'Card holder and issuing bank not registered as a 3D Secure'
			,1 => 'One of card holder or issuing bank not registered as a 3D Secure'
			,2 => 'Card holder and issuing bank are 3D Secure. 3dSecure authentication successful'
			,5 => 'Card holder and issuing bank are 3D Secure. 3dSecure authentication successful'
			,6 => 'One of card holder or issuing bank not registered as a 3D Secure'
			,7 => 'Card holder and issuing bank not registered as a 3D Secure'
		], intval($eci), 'Unknown code'))
	;}
}