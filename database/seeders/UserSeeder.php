<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'Administrator',
            'username' => 'Admin354',
            'email' => 'admin@gmail.com',
            'nomor_identitas' => '11210910000023',
            'role' => 1,
            'password' => Hash::make('Admin123'),
            'backup_pass' => 'Admin123',
            'token' => 's'
        ]);

        DB::table('users')->insert([
            'name' => 'John Doe',
            'username' => 'JohnDoe',
            'email' => 'john@gmail.com',
            'nomor_identitas' => '13300190000077',
            'role' => 2,
            'password' => Hash::make('JohnDoe123'),
            'backup_pass' => 'JohnDoe123',
            'token' => 's'
        ]);

        DB::table('users')->insert([
            'name' => 'Siti Aminah',
            'username' => 'SitiAminah',
            'email' => 'siti@gmail.com',
            'nomor_identitas' => '13300190000087',
            'role' => 2,
            'password' => Hash::make('Aminah123'),
            'backup_pass' => 'Aminah123',
            'token' => 's'
        ]);

        DB::table('users')->insert([
            'name' => 'Satria Aditama',
            'username' => 'Saitama123',
            'email' => 'satria@gmail.com',
            'nomor_identitas' => '11210910000019',
            'role' => 1,
            'password' => Hash::make('Satria123'),
            'backup_pass' => 'Satria123',
            'token' => 's'
        ]);

        DB::table('users')->insert([
            'name' => 'Ananta Dwiyana Sandra',
            'username' => 'Ananta1305',
            'email' => 'ananta@gmail.com',
            'nomor_identitas' => '11210910000073',
            'role' => 3,
            'password' => Hash::make('Ananta123'),
            'backup_pass' => 'Ananta123',
            'token' => 's'
        ]);

        DB::table('users')->insert([
            'name' => 'Putri Syakila',
            'username' => 'SyakilaBogor',
            'email' => 'syakila@gmail.com',
            'nomor_identitas' => '11210910000017',
            'role' => 3,
            'password' => Hash::make('Syakila123'),
            'backup_pass' => 'Syakila123',
            'token' => 's'
        ]);

        DB::table('users')->insert([
            'name' => 'Muhammad Rafly',
            'username' => 'CucusFarhan',
            'email' => 'rafly@gmail.com',
            'nomor_identitas' => '11210910000020',
            'role' => 3,
            'password' => Hash::make('CucusFarhan123'),
            'backup_pass' => 'CucusFarhan123',
            'token' => 's'
        ]);

        DB::table('users')->insert([
            'name' => 'Ahmad Sanjaya',
            'username' => 'Ahmad123',
            'email' => 'sanjaya@gmail.com',
            'nomor_identitas' => '11210910000038',
            'role' => 2,
            'password' => Hash::make('Sanjaya123'),
            'backup_pass' => 'Sanjaya123',
            'token' => 's'
        ]);
    }
}
