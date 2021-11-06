<?php

namespace Database\Seeders;

use App\Models\Paste;
use Illuminate\Database\Seeder;

class PasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paste::factory()->count(200)->create();
    }
}
