<?php
namespace App\Http\Controllers\Auth\Traits;

trait LogsInUsersTrait
{
    public function loginUser(array $data)
    {
        if (!auth()->attempt($data)) {
            return null;
        }

        $user  = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token
        ];
    }

}
