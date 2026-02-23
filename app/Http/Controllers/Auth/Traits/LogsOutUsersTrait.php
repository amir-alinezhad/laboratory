<?php
namespace App\Http\Controllers\Auth\Traits;
use App\Models\Status;

trait LogsOutUsersTrait{


    public function logOutUser($data)
    {
        $user = $data->user();


        $deActiveStatus = Status::where('name', 'غیر فعال')->first();
        $user->update(['status_id' => $deActiveStatus->id]);

        $user->currentAccessToken()->delete();
    }
}
