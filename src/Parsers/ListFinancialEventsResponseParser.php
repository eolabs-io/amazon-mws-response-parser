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
								'ProductAdsPaymentEvent', 
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
								'TDSReimbursementEvent', ]);
	}

	public function getContentAccessor(): string
	{
		return 'FinancialEvents';
	}

}