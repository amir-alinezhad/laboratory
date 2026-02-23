<?php

namespace App\Http\Controllers\Auth\Dentist;

use App\Http\Controllers\Auth\Traits\LogsInUsersTrait;
use App\Http\Controllers\Auth\Traits\LogsOutUsersTrait;
use App\Http\Controllers\Auth\Traits\RegistersUsersTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DentistAuthController extends Controller
{
    use RegistersUsersTrait, LogsInUsersTrait, LogsOutUsersTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Register(Request $request)
    {
        try {
            DB::beginTransaction();

            $validation = $request->validate([
                'name'       => 'required|string|max:255',
                'email'      => 'required|email|unique:users',
                'password'   => 'required|min:6',
                'address'    => 'required|string|max:255',
                'clinicName' => 'required|string|max:255',
                'phone'      => 'required|string|max:255|digits:11',
            ]);
            $user = $this->performRegister($validation);

            auth()->login($user);

            DB::commit();

            return response()->json([
                'message' => 'ثبت نام موفق بود'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'خطا در ثبت نام',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            DB::beginTransaction();
            $credentials = $request->validate([
                'phone'    => 'required|digits:11',
                'password' => 'required|min:6',
            ]);

            $result = $this->loginUser($credentials);

            if (!$result) {
                return response()->json([
                    'message' => 'ایمیل یا رمز عبور اشتباه است'
                ], 401);
            }

            DB::commit();
            return response()->json([
                'message' => 'ورود موفق بود',
                'token'   => $result['token'],
                'user'    => $result['user']
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'خطا در ورود',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function LogOut(Request $request)
    {
      $this->logoutUser($request);
    }
}
