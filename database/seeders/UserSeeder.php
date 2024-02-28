<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'وزارة الصحة',
            'email' => Str::random(10) . '@libya.com',
            'username' => 'ministry',
            'password' => Hash::make('password'),
            'image' => Null,
            'role' => 'users_health_ministry',
        ]);
    }

    private function getRandomRole()
    {
        $roles = ['users_app', 'users_health_center', 'users_health_ministry'];
        return $roles[array_rand($roles)];
    }
}
