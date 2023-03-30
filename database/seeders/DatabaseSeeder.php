<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Shift;
use App\Models\Profile;
use App\Models\Division;
use App\Models\Position;
use App\Models\MonthlyRecap;
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

        Division::create([
            'name' => 'Sistem Informasi Siber dan Sandi',
            'member_sum' => 10,
            'slug' => 'siss'
        ]);

        Position::create([
            'name' => 'STAFF',
            'slug' => 'staff'
        ]);

        Shift::create([
            'name' => 'SHIFT NORMAL',
            'hour_in' => 7,
            'minute_in' => 30,
            'hour_out' => 16,
            'minute_out' => 0,
        ]);

        User::create([
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@gmail.com'),
        ]);

        MonthlyRecap::create([
            'month' => 'Januari',
            'num' => '01'
        ]);
        MonthlyRecap::create([
            'month' => 'Februari',
            'num' => '02'
        ]);
        MonthlyRecap::create([
            'month' => 'Maret',
            'num' => '03'
        ]);
        MonthlyRecap::create([
            'month' => 'April',
            'num' => '04'
        ]);
        MonthlyRecap::create([
            'month' => 'Mei',
            'num' => '05'
        ]);
        MonthlyRecap::create([
            'month' => 'Juni',
            'num' => '06'
        ]);
        MonthlyRecap::create([
            'month' => 'Juli',
            'num' => '07'
        ]);
        MonthlyRecap::create([
            'month' => 'Agustus',
            'num' => '08'
        ]);
        MonthlyRecap::create([
            'month' => 'September',
            'num' => '09'
        ]);
        MonthlyRecap::create([
            'month' => 'Oktober',
            'num' => '10'
        ]);
        MonthlyRecap::create([
            'month' => 'November',
            'num' => '11'
        ]);
        MonthlyRecap::create([
            'month' => 'Desember',
            'num' => '12'
        ]);
    }
}
