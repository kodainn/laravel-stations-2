<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Sheet;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function movie(Request $request)
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

        return view('movie', [
            'movies' => $movies
        ]);
    }


    public function sheet()
    {
        $sheets = Sheet::all();
        $sheetList = [];

        foreach($sheets as $sheet) {
            $sheetList[$sheet['row']][] = $sheet['row'] . '-' . $sheet['column'];
        }

        return view('sheet', [
            'sheetList' => $sheetList
        ]);
    }
}
