<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Sheet;
use Illuminate\Http\Request;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class MovieController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->input('keyword');
        $isShowing = $request->input('is_showing');

        $query = Movie::query();

        // キーワード検索
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%");
            });
        }

        // ラジオボタンでの絞り込み
        if ($isShowing !== null && $isShowing !== "on") {
            $query->where('is_showing', $isShowing);
        }

        $movies = $query->paginate(20);

        return view('user.index', [
            'movies' => $movies
        ]);
    }


    public function detail($id)
    {
        $movie = Movie::where('id', '=', $id)->first();
    
        $schedules = Schedule::where('movie_id', '=', $id)->orderBy('start_time', 'asc')->get();

        return view('user.detail', [
            'movie' => $movie,
            'schedules' => $schedules
        ]);
    }
}
