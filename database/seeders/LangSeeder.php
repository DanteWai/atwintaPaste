<?php

namespace Database\Seeders;

use App\Models\Lang;
use Illuminate\Database\Seeder;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lang::insert([
            ['title' => 'C++'],
            ['title' => 'C#'],
            ['title' => 'JavaScript'],
            ['title' => 'PHP'],
        ]);
    }
}
