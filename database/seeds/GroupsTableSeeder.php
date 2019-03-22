<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => 'Super Admin Or Developer',
            'code' => 'developer',
            'permissions' => '',
            'description' => '',
            'updated_at' => new DateTime,
            'created_at' => new DateTime,
        ]);
    }
}
