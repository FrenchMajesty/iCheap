<?php

namespace App\Traits\Shipping;

use Shippo_Shipment;
use Shippo_Transaction;

trait Shippable
{
	/**
	 * Create and process a shippo order for sending an item from an address to another
	 * @param  array  $item Package informations of the item being sent
	 * @param  array  $from Address informations about the origin of the package
	 * @param  array  $to   Address informations about the destination
	 * @return array       The shipment and transaction details
	 */
	public static function ship(array $item, array $from, array $to)
	{
		$shipment = Shippo_Shipment::create([
            'address_from' => $from,
            'address_to' => $to,
            'parcels' => [$item],
            'async' => false,
        ]);

        $rate = collect($shipment['rates'])->sortBy('amount')->first();

        $transaction = Shippo_Transaction::create([
            'rate' => $rate['object_id'],
            'async' => false,
        ]);

        return [
            'shipment' => $shipment,
            'transaction' => $transaction,
        ];
	}
}