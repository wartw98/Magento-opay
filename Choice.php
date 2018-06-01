<?php
namespace Dfe\AllPay;
use Df\Payment\W\Event;
use Magento\Framework\Phrase;

final class Choice extends \Df\Payment\Choice {
	
	function title() {return dfc($this, function() {return /** @var Event $ev */
		($ev = $this->responseF()) ? __($ev->tl()) : (
			
			!$this->m()->plan() ? null : df_cc_br(__('Bank Card (Installments)'), __('Not yet paid'))
		)
	;});}
}