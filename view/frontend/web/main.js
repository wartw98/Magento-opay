// 2016-08-04
define([
	'df', 'df-lodash', 'Df_Payment/withOptions', 'Dfe_AllPay/plan', 'jquery', 'ko'
], function(df, _, parent, Plan, $, ko) {'use strict';

return parent.extend({
	
	defaults: {df: {formTemplate: 'Dfe_AllPay/form'}},
	
	dfFormAfterRender: function(element, _this) {
		var t = function() {_this.dfForm().toggleClass('df-wide', 575 <= $('#payment').width());};
		t();
		$(window).resize(t);
	},
	
	dfFormCssClasses: function() {return this._super().concat([
		this.needShowOptions() ? 'with-options' : null, this.hasPlans() ? 'has-plans' : null
	]);},
	
	hasPlans: function() {return !!this.iPlans().length;},
	
	initialize: function() {
		this._super();
		var canPlaceOrder = this.canPlaceOrder;
		
		this.canPlaceOrder = ko.computed(function() {return canPlaceOrder.call(this) &&
			
			this.option()
		;}, this);
		return this;
	},
	
	installment: function() {return this.config('installment');},
	
	iPlans: df.c(function() {
		 var rateToCurrent = this.config('currencyRateFromBaseToCurrent');
		var option = this.option;
		return $.map(this.installment().plans, function(p) {return Plan({
			fee: parseFloat(p.fee)
			,numPayments: df.int(p.numPayments)
			,option: option
			,rate: parseFloat(p.rate)
		}, rateToCurrent);});
	}),
	
	oneOff: function() {return df.t('One-off Payment: %s', this.dfc.formatMoney(this.dfc.grandTotal()));},
	
	oneOffOptions: function() {return df.t('The following payment options are available: %s.',
	   _.values(this.options()).join(', ')
	);},
	
	oneOffTemplate: df.c(function() {
		
		var s = this.needShowOptions() ? 'withOptions' : (this.hasPlans() ? 'simple' : null);
		return !s ? null : 'Dfe_AllPay/one-off/' + s;
	})
});});
