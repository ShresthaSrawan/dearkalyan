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
        $user->name = 'Dear Kalyan';
        $user->email = 'dearkalyan@gmail.com';
        $user->password = bcrypt('p@ssword');
        $user->dob = '2040/1/1';
        $user->address1 = 'Somewhere, United States';
        $user->address2 = 'Kathmandu, Nepal';
        $user->subtitle = 'Radio Announcer';
        $user->description = 'Kalyan who is born as son to Yuvaraj Gautam and Nama Gautam at Bijauri-4 of  Dang District, these days work as a radio presenter in Hits FM.  Below, we have presented a conversation made by our correspondent with Dear Kalyan who has succeeded to get appreciation from hundreds and thousands of audiences through his program "Mero Katha Mero Geet" which he had started since the time he entered into FM sector.';
        $user->phone = '980-4564668';
        $user->email = 'dearkalyan@gmail.com';
        $user->facebook = 'http://facebook.com/dear.kalyan';
        $user->gmail = '#';
        $user->twitter = '#';
        $user->save();

        $user->image()->create(['path' => 'images/dk.jpg']);
    }
}
