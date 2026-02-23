<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
        Status::insert([
                [
                    'name' => 'تایید شده',
                    'class_name' => 'success',
                ],
                [
                    'name' => 'رد شده',
                    'class_name' => 'danger',
                ],
                [
                    'name' => 'در انتظار تایید',
                    'class_name' => 'danger',
                ],
                [
                    'name' => 'فعال',
                    'class_name' => 'success',
                ],
                [
                    'name' => 'غیر فعال',
                    'class_name' => 'danger',
                ]
            ]
        );
        Role::insert([
            [
                'name' => 'dentist',
                'guard_name' => 'web'
            ],[
                'name' => 'Lab',
                'guard_name' => 'web'
            ],

        ]);
    }
}
