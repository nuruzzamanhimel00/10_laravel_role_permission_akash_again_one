<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','nuruzzaman147@gmail.com')->first();
        if(is_null($user)){
            $user = new User();
            $user->name = "Nuruzzaman Himel";
            $user->email = "nuruzzaman147@gmail.com";
            $user->password= Hash::make("123456789");
            $user->remember_token = Str::random(10);
            $user->save();
        }
    }
}
