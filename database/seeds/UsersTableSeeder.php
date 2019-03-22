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
            'password' => bcrypt('arif.saiket@gmail.com'),
            'updated_at' => new DateTime,
            'created_at' => new DateTime,
        ]);
    }
}
