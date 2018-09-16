<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call([
            FestivalsTableSeeder::class,
            TicketTypesTableSeeder::class,
            UsersTableSeeder::class,
            OrdersTableSeeder::class,
            TicketsTableSeeder::class,

        ]);
    }
}
