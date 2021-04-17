<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Genre;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilmTest extends TestCase
{
    use  WithFaker;

    function test_admin_can_post_film(){

        $this->withExceptionHandling();
        $genre_id = Genre::first()->id;
        
        $response =  $this->post("film", [
            'title' => $this->faker->word(),
            'description' => $this->faker->word(),
            'genre_id' => 1,
            'cost' => rand(10,100),
            'year' => $this->faker->year(),
            'rating' => 3,
            'images' => $this->faker->image(public_path('images'),400,300, null, false),
    ]);
        
        $response->assertStatus(302);
        // $response->assertJson([
        //     'url' => "https://subscriber.test/test1",
        //     'topic' => $title,
        // ]);

    }

}
