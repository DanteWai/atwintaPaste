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
            ['title' => 'C++', 'alias' => 'c++'],
            ['title' => 'C#', 'alias' => 'csharp'],
            ['title' => 'JavaScript', 'alias' => 'js'],
            ['title' => 'PHP', 'alias' => 'php'],
            ['title' => 'Css', 'alias' => 'css'],
        ]);
    }
}
