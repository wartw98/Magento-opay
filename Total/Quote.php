<?php
namespace Dfe\AllPay\Total;
use Dfe\AllPay\InstallmentSales\Plan\Entity as Plan;
use Dfe\AllPay\Method as M;
use Dfe\AllPay\Settings as S;
use Dfe\AllPay\TWD;
use Magento\Payment\Model\InfoInterface as IPayment;
use Magento\Quote\Api\Data\ShippingAssignmentInterface as IShippingAssignment;
use Magento\Quote\Model\Quote as Q;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Model\Quote\Address\Total\CollectorInterface;
use Magento\Quote\Model\Quote\Payment as QP;
use Magento\Quote\Model\ShippingAssignment;
use Magento\Sales\Model\Order\Payment as OP;

class Quote extends AbstractTotal {
	
	function collect(Q $quote, IShippingAssignment $shippingAssignment, Total $total) {
		
		if (($qp = dfp($quote)) && $qp->getMethod() === M::codeS() && ($planId = dfp_iia($qp, 'plan'))) {
			$s = dfps($qp); 
			$plan = df_assert($s->installmentSales()->plans($planId)); 
			$this->setCode('dfe_allpay');
			parent::collect($quote, $shippingAssignment, $total);
			$quoteCurrency = $quote->getQuoteCurrencyCode(); 
			$baseCurrency = $quote->getBaseCurrencyCode(); 
			
			$totals = array_sum($total->getAllTotalAmounts()); 
			$totalsNew = $plan->amount($totals, $quoteCurrency); 
			$fee = TWD::round($totalsNew - $totals, $quoteCurrency); 
			$this->_setAmount($fee);
			$baseTotals = array_sum($total->getAllBaseTotalAmounts()); 
			$baseTotalsNew = $plan->amount($baseTotals, $baseCurrency); 
			$feeBase = TWD::round($baseTotalsNew - $baseTotals, $baseCurrency); 
			$this->_setBaseAmount($feeBase);
			$this->iiAdd($qp, $fee, $feeBase);
		}
		return $this;
	}

	
	function fetch(Q $quote, Total $total) {return [];}

	
	private function iiAdd(QP $payment, $fee, $feeBase) {
		
		$id = df_assert(intval($this->_getAddress()->getId()));
		$values = df_eta($payment->getAdditionalInformation(self::$II_KEY));
		$payment->setAdditionalInformation(self::$II_KEY,
			[$id => [self::$II_FEE => $fee, self::$II_FEE_BASE => $feeBase]] + $values
		);
	}

	
	static function iiGet(IPayment $payment) {
		
		$values = df_eta($payment->getAdditionalInformation(self::$II_KEY));

		$fee = 0;
		$feeBase = 0;
		foreach ($values as $valuesForAddress) {
			$fee += $valuesForAddress[self::$II_FEE];
			$feeBase += $valuesForAddress[self::$II_FEE_BASE];
		}
		return [$fee, $feeBase];
	}

	
	private static $II_KEY = 'dfe_allpay';

	
	private static $II_FEE = 'fee';

	
	private static $II_FEE_BASE = 'feeBase';
}