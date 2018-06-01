<?php
namespace Dfe\AllPay;
use Df\Payment\Settings\Options as O;
use Dfe\AllPay\InstallmentSales\Plan\Entity as Plan;
use Dfe\AllPay\Source\Option;
use Magento\Sales\Model\Order\Item as OI;

final class Charge extends \Df\PaypalClone\Charge {
	
	protected function k_Amount() {return 'TotalAmount';}
	
	
	protected function k_MerchantId() {return 'MerchantID';}

	
	protected function k_RequestId() {return 'MerchantTradeNo';}

	
	protected function k_Signature() {return 'CheckMacValue';}

	
	protected function pCharge() {return $this->descriptionOnKiosk() + [
		
		'ChoosePayment' => $this->pChoosePayment()
		
		,'ChooseSubPayment' => ''
		
		,'ClientBackURL' => $this->customerReturn()
		
		,'ClientRedirectURL' => ''
		
		,'DeviceSource' => ''
		
		,'EncryptType' => 0
		
		,'ExpireDate' => $this->s()->waitPeriodATM()
		
		,'HoldTradeAMT' => 0
		
		,'IgnorePayment' => $this->pIgnorePayment()
		
		,'InstallmentAmount' => !$this->plan() ? 0 : $this->amountF()
		
		,'InvoiceMark' => ''
		
		,'ItemName' => df_oqi_s($this->o(), '#')
		
		,'ItemURL' => $this->productUrls()
		
		,'MerchantTradeDate' => df_now('Y/m/d H:i:s', Method::TIMEZONE)
		
		,'NeedExtraPaidInfo' => 'Y'
		
		,'OrderResultURL' => $this->customerReturnRemote()
		
		,'PaymentInfoURL' => $this->callback(self::OFFLINE)
		
		,'PaymentType' => 'aio'
		,'PlatformID' => ''
		
		,'Remark' => ''
		
		,'ReturnURL' => $this->callback()
		
		,'TradeDesc' => $this->description()
	];}

	
	private function descriptionOnKiosk() {
		
		$lines = df_explode_n($this->text($this->s()->descriptionOnKiosk()));
		
		$n = 1;
		
		$result = [];
		foreach ($lines as $line) {
			
			$result['Desc_' . $n++] = mb_substr($line, 0, 20);
			if ($n > 4) {
				break;
			}
		}
		return $result;
	}

	
	private function isSingleOptionChosen() {return dfc($this, function() {return
		$this->m()->option() || 1 === count($this->s()->options()->allowed())
	;});}

	
	private function pChoosePayment() {return dfc($this, function() {
		
		$o = $this->s()->options();
		return $this->plan() ? Option::BANK_CARD : ($this->m()->option() ?: (
			!$o->isLimited() || !$this->isSingleOptionChosen() ? 'ALL' : df_first($o->allowed())
		));
	});}

	
	private function pIgnorePayment() { $o = $this->s()->options(); return df_ccc('#',
		
		array_merge(['ALL' === $this->pChoosePayment() ? 'Alipay' : null],
			!$o->isLimited() || $this->isSingleOptionChosen() ? [] : $o->denied()
		)
	);}

	
	private function plan() {return $this->m()->plan();}

	
	private function productUrls() {return df_ccc('+', $this->oiLeafs(function(OI $i) {return df_oqi_url($i);}));}

	
	const OFFLINE = 'offline';
}