<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Collection;

class ListFinancialEventsResponseParser extends BaseParser
{

	public function getElementsToRemove(): Collection
	{
		$elements = parent::getElementsToRemove();

		return $elements->merge(['ProductAdsPaymentEvent',
								'RentalTransactionEvent',
								'PayWithAmazonEvent',
								'ServiceFeeEvent',
								'ServiceProviderCreditEvent',
								'SellerDealPaymentEvent',
								'DebtRecoveryEvent',
								'ShipmentEvent',
								'AffordabilityExpenseEvent',
								'RetrochargeEvent',
								'GuaranteeClaimEvent',
								'ChargebackEvent', 
								'LoanServicingEvent',
								'RefundEvent',
								'AdjustmentEvent',
								'PerformanceBondRefundEvent',
								'AffordabilityExpenseReversalEvent',
								'TDSReimbursementEvent', 
								'OrderCharge',
								'OrderChargeAdjustment',
								'ShipmentItem',
								'ShipmentFee',
								'ShipmentFeeAdjustment',
								'OrderFee',
								'OrderFeeAdjustment',
								'DirectPayment',
								'ItemCharge',
								'ItemTaxWithheld',
								'ItemFee',
								'ItemFeeAdjustmen',
								'Promotion',
								'PromotionAdjustment',
								'ItemChargeAdjustment',
								'ItemFeeAdjustment',
								'RefundEvent',
								'GuaranteeClaimEvent',
								'ChargebackEvent',
								'Fee',
								'CouponPaymentEvent',
								'SAFETReimbursementEvent',
								'SAFETReimbursementItem',
								'SellerReviewEnrollmentPaymentEvent',
								'FBALiquidationEvent',
								'NetworkComminglingTransactionEvent',

								'ChargeComponent',
								'FeeComponent',
								'TaxWithheldComponent',
							]);
	}

	public function getElementsToIgnore(): Collection
	{
		$elements = parent::getElementsToIgnore();

		return $elements->merge(['CouponPaymentEvent|FeeComponent',
								 'CouponPaymentEvent|ChargeComponent',
								 'SellerReviewEnrollmentPaymentEvent|FeeComponent',
								 'SellerReviewEnrollmentPaymentEvent|ChargeComponent',
								]);
	}

	public function getContentAccessor(): string
	{
		return 'FinancialEvents';
	}

}