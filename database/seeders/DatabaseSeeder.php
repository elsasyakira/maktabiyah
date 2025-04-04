<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            [
                "id" => 1,
                "name" => "admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make("123123123"),
                "role" => "admin",
                "syubah" => null
            ],
            [
                "id" => 2,
                "name" => "dudung",
                "email" => "dudung@gmail.com",
                "password" => Hash::make("123123123"),
                "role" => "jamiah",
                "syubah" => "AsySyuhada"
            ],
            [
                "id" => 3,
                "name" => "ujang",
                "email" => "ujang@gmail.com",
                "password" => Hash::make("123123123"),
                "role" => "syubah",
                "syubah" => "AsySyuhada"
            ],
            [
                "id" => 4,
                "name" => "asep",
                "email" => "asep@gmail.com",
                "password" => Hash::make("123123123"),
                "role" => "mudir",
                "syubah" => "AsySyuhada"
            ]
        ]);
    }
}
