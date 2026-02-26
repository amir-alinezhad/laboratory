<?php
namespace App\Http\Controllers\Traits;
use App\Http\Enums\StatusEnums;
use App\Models\Dentist;
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
        $token = $user->createToken('auth_token')->plainTextToken;

        Dentist::create([
                'user_id' => $user->id,
                'created_at' => now(),
                'clinic_name' =>$data['clinicName'],
                'address' =>$data['address'],
            ]);

return $user;
//        return [
//            'user'  => $user,
//            'token' => $token
//        ];
    }

    public function activeStatus()
    {
        return Status::where('name', StatusEnums::ACTIVE)->first();
    }

}
