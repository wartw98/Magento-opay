
define(['df', 'df-lodash', 'Df_Checkout/data'], function(df, _, dfc) {'use strict'; return(
	
	function(plan, rateToCurrent) {return {

	amount: df.c(function() {return Math.round(
		dfc.grandTotal() * (1 + plan.rate / 100) + plan.fee * rateToCurrent * plan.numPayments
	);}),

	amountS: function() {return dfc.formatMoney(this.amount());},
	
	domId: function() {return 'df-plan-' + plan.numPayments;},
	/**
	 * 無須自行計算各分期金額，除不盡的金額銀行會於第一期收取。
	 * 舉例：總金額 1733元 分 6 期，除不盡的放第一期，293，288，288，288，288，288»
	 * @returns {Number}
	 */
	firstPayment: df.c(function() {
		 var remainder = this.amount() % plan.numPayments;
		 var singlePaymentAmount = Math.floor(this.amount() / plan.numPayments);
		return remainder + singlePaymentAmount;
	}),
	
	firstPaymentS: function() {return dfc.formatMoney(this.firstPayment());},
	
	numPayments: plan.numPayments,
	
	onRowClicked: function(_this, event) {
		plan.option(_this.numPayments);
		
		return true;
	}
};});});
