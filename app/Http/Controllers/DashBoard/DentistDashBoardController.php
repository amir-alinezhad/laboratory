<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\DentistDashboardTrait;
use App\Models\Dentist;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class DentistDashBoardController extends Controller
{
    use DentistDashboardTrait;

    public function search(Request $request)
    {

        $search = $request->query('name');
        $dentistId = $request->user()->dentist->id;
        $orders = Order::with(['patient', 'status'])
            ->where('dentist_id', $dentistId)
            ->when($search, function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhereHas('patient', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->get()
            ->map(function ($order) {
                return [
                    'orderID' => $order->id,
                    'dentistID' => $order->dentist_id,
                    'orderStatus' => $order->status->name,
                    'patientName' => $order->patient->full_name,
                ];
            });


        return response()->json([
            'orders' => $orders
        ]);
    }

    public function notification(Request $request)
    {

        $userID = $request->user()->id;

        $notifs = Notification::where('user_id', $userID)
            ->select(['title', 'message', 'created_at'])
            ->get();

        return response()->json($notifs);
    }

    public function dashboard(Request $request)
    {
//        return response()->json($request->user()->dentist);
        try {
            $dentistId = $request->user()->dentist->id;
            $orders = $this->ordersList($dentistId);
            return response()->json($orders);
        }
        catch (\Exception $e) {
            return response()->json([$e->getMessage()]);
        }

    }
}
