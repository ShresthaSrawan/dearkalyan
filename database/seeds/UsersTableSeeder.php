<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        
        $user = new User;
        $user->name = "Dearkalyan";
        $user->email = "dearkalyan@gmail.com";
        $user->password = bcrypt('p@ssword');
        $user->save();
    }
}
