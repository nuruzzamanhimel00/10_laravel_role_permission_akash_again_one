<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
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
        $admin = Admin::where('email','superadmin@gmail.com')->first();
        if(is_null($admin)){
            $admin = new Admin();
            $admin->name = "auperadmin";
            $admin->username = "auperadmin";
            $admin->email = "superadmin@gmail.com";
            $admin->password= Hash::make("123456789");
            $admin->remember_token = Str::random(10);
            $admin->save();

        }
    }
}
