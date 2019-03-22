<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'group_id' => '1',
            'name' => 'Developer',
            'name_bangla' => 'ডেভেলপার',
            'email' => 'arif.saiket@gmail.com',
            'email_verified_at' => new DateTime,
            'password' => bcrypt('123456789'),
            'updated_at' => new DateTime,
            'created_at' => new DateTime,
        ]);
    }
}
