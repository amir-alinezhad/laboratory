<?php
namespace App\Http\Controllers\Auth\Traits;
use App\Http\Enums\StatusEnums;
use App\Models\Dentist;
use App\Models\Lab;
use App\Models\Status;
use App\Models\User;

trait RegistersUsersTrait{

    protected function performRegister(array $data)
    {


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'status_id' =>$this->activeStatus()->id,
        ]);


        // همه به صورت پیشفرض dentist
        $user->assignRole('dentist');

            Dentist::create([
                'user_id' => $user->id,
                'created_at' => now(),
                'clinic_name' =>$data['clinicName'],
                'address' =>$data['address'],
            ]);


        return $user;
    }

    public function activeStatus()
    {
        return Status::where('name', StatusEnums::ACTIVE)->first();
    }

}
