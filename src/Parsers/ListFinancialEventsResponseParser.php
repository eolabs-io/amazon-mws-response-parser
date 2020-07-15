<?php

namespace EolabsIo\AmazonMwsResponseParser\Parsers;

use EolabsIo\AmazonMwsResponseParser\Parsers\BaseParser;
use Illuminate\Support\Collection;

class ListFinancialEventsResponseParser extends BaseParser
{

	public function getElementsToRemove(): Collection
	{
		$element = parent::getElementsToRemove();

		return $element->merge(['ProductAdsPaymentEvent',
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
								'OrderCharge'
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
							]);
	}

	public function getContentAccessor(): string
	{
		return 'FinancialEvents';
	}

}