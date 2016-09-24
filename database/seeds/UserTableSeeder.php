<?php
class UserTableSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'username' => 'GuaHsu',
            'email'    => 'GuaHsu@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}