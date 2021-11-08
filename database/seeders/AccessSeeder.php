<?php

namespace Database\Seeders;

use App\Models\Access;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Access::insert([
            ['title' => 'public'],
            ['title' => 'unlisted'],
            ['title' => 'private'],
        ]);
    }
}
