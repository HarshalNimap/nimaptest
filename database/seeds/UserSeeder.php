<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'id' => '1',
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' =>  Hash::make('admin@123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            )
        );
        User::insert($data);
    }
}
