<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieContoller extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movie', [
            'movies' => $movies
        ]);
    }
}
