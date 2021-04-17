<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::all();
        $genre = Genre::all();
        return view("purchase", ['films' => $films, 'genres' => $genre]);
    }

    public function films()
    {
        $films = Film::with('genre')->get();
        return view('manage', ['films' => $films]);
    }


    public function search(Request $request)
    {
        $genre = Genre::all();
        $films = Film::where('status','active');
        if($request->genre != ""){
            $films->where('genre',  $request->genre);
        }

        if($request->title != ""){
            $films->where('title', 'LIKE', "%{$request->title}%");
        }

        return view("purchase", ['films' => $films->get(), 'genres' => $genre]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = Genre::all();
        return view("create_film" , ['genres' => $genre ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'genre_id' => 'required|string',
            'year' => 'required|int',
            'rating' => 'required|int',
            'cost' => 'required|int',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.auth()->user()->name.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        Film::create([
            'title' => $request->title,
            'description' => $request->description,
            'genre_id' => $request->genre_id,
            'cost' => $request->cost,
            'year' => $request->year,
            'rating' => $request->rating,
            'image' => $imageName
        ]);

        return back()->with('success','You have successfully create a film.');

    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        $genre = Genre::all();
        return view("update_film" , ['film' => $film, 'genres' => $genre ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        $this->validate_film($request);
            $film->update([
                'title' => $request->title,
                'description' => $request->description,
                'genre_id' => $request->genre_id,
                'cost' => $request->cost,
                'year' => $request->year,
                'rating' => $request->rating,
        ]);

        if($request->has('image')){

            $this->validate_film($request);

            Storage::delete("images/".$film->image);
            $imageName = time().'.'.auth()->user()->name.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $film->update(['image' => $imageName]);

        }
        return back()->with('success','You have successfully updated the film.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->delete();
        return back()->with('success', 'You have successfully delete the movie');
    }


    public function validate_film($request)
    {
       $validate =  $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'genre_id' => 'required|int',
            'cost' => 'required|int',
            'year' => 'required|int',
            'rating' => 'required|int',
        ]);


        if($request->has('image')){
            $validate =  $this->validate($request, ['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
        }

        return $validate;
        
    }

    
}
