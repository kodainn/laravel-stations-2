<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $titleSearch = [];
        $descriptionSearch = [];
        $isShowingSearch = [];
        if(!empty($request->keyword)) {
            $titleSearch[] = ['title', 'like', '%' . $request->keyword . '%'];
            $descriptionSearch[] = ['description', 'like', '%' . $request->keyword . '%'];
        }
        if(!empty($request->is_showing) && (int) $request->is_showing !== 2) {
            $isShowingSearch[] = ['is_showing', '=', $request->is_showing];
        }

        $movies = Movie::where(function($query) use($titleSearch, $descriptionSearch) {
                        $query->where($titleSearch)->orWhere($descriptionSearch);
                    })
                    ->where($isShowingSearch)
                    ->paginate(20);

        return view('movie', [
            'movies' => $movies
        ]);
    }
}
