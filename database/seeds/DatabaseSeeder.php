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
        $this->call(DepartmentsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TandemsTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(StickyNotesTableSeeder::class);
        $this->call(ConversationsTableSeeder::class);
        $this->call(BoardsTableSeeder::class);
    }
}
