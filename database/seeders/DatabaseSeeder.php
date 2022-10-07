<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $this->call([
            Hotel::class,
            RoomCategory::class,
            Hotel_roomCat::class,
            Guest::class,
            Room::class,
        ]);

        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'User Admin',
            'email' => 'admin@gmail.com',
        ]);
    }
}
