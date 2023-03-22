<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Profile;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Division::create([
        //     'name' => 'Sistem Informasi Siber dan Sandi',
        //     'member_sum' => 10,
        //     'slug' => 'siss'
        // ]);

        // Position::create([
        //     'name' => 'STAFF',
        //     'slug' => 'staff'
        // ]);


        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@gmail.com'),
        ]);
    }
}
