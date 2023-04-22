<?php

namespace Database\Seeders;

use App\Models\Lists;
use Illuminate\Database\Seeder;

class ListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lists::factory(150)->create();
    }
}
