<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RolSeeder::class]);

        User::create([
            'name'=> 'Meehl Cedeño',
            'email'=> 'admin@admin.com',
            'password'=> Hash::make('12345678')
        ])->assignRole('ADMINISTRADOR');
    }
}
