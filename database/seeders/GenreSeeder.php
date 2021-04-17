<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([ 'name' => 'Action' ]);
        Genre::create([ 'name' => 'Comedy' ]);
        Genre::create([ 'name' => 'War' ]);
        Genre::create([ 'name' => 'Sci-fi' ]);
    }
}
