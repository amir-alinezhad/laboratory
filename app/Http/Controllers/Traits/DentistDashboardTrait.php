<?php

namespace App\Http\Controllers\Traits;
use App\Models\OrderItem;

trait DentistDashboardTrait
{
    public function ordersList($dentistId)
    {
        return OrderItem::with([
            'order.patient',
            'order.status',
            'product.service'
        ])
            ->whereHas('order', function ($query) use ($dentistId) {
                $query->where('dentist_id', $dentistId);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'orderItemID' => $item->id,
                    'orderID' => $item->order->id,
                    'dentistID' => $item->order->dentist_id,
                    'patientID' => $item->order->patient->id,
                    'patientName' => $item->order->patient->full_name,
                    'orderStatus' => $item->order->status->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'service' => $item->product->service->name,
                ];
            });
    }
}
