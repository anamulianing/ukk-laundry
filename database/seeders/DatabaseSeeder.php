<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('outlets')->insert([
            [
                'nama' => 'Toko Ubud Laundry',
                'alamat' => 'Padaherang',
                'tlp' => '111222555666',
            ],
            [
                'nama' => 'Toko Ibid Laundry',
                'alamat' => 'Kalipucang',
                'tlp' => '333777999465',
            ],
        ]);

        DB::table('users')->insert([
            [
                'nama'=>'Administrator',
                'username'=>'admin',
                'password'=>bcrypt('1234'),
                'role'=>'admin',
                'outlet_id'=>1,
            ],
            [
                'nama'=>'Kasir',
                'username'=>'kasir',
                'password'=>bcrypt('1234'),
                'role'=>'kasir',
                'outlet_id'=>1,
            ],
            [
                'nama' => 'Pemilik',
                'username' => 'owner',
                'password' => bcrypt('1234'),
                'role' => 'owner',
                'outlet_id' => '1',
            ],
        ]);

        

        DB::table('members')->insert([
            [
                'nama' => 'Dodo Sidodo',
                'jenis_kelamin' => 'L',
                'alamat' => 'Padaherang',
                'tlp' => '999888222666',
            ],
            [
                'nama' => 'Mega',
                'jenis_kelamin' => 'P',
                'alamat' => 'Padaherang',
                'tlp' => '083285739164',
            ],
            [
                'nama' => 'Joko',
                'jenis_kelamin' => 'L',
                'alamat' => 'Banjarsari',
                'tlp' => '777222444333',
            ],
        ]);
    }
}
