<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;


class MovieAdminController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        return view('admin.index', [
            'movies' => $movies
        ]);
    }

    public function show($id)
    {
        $movie = Movie::with('schedules')
                    ->where('id', '=', $id)
                    ->first();
        
        return view('admin.show', [
            'movie' => $movie
        ]);
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:movies',
            'image_url' => 'required|url',
            'published_year' => 'required',
            'is_showing' => 'required',
            'genre' => 'required',
            'description' => 'required'
        ]);

        try {
            DB::beginTransaction();
            unset($request['_token']);

            $genre = Genre::where('name', '=', $request->genre)->first();

            if(empty($genre)) {
                Genre::insert([
                    ['name' => $request->genre]
                ]);

                $newGenre = Genre::orderBy('id', 'desc')->first();
                $request['genre_id'] = $newGenre->id;
                unset($request['genre']);
                Movie::insert([$request->all()]);

                DB::commit();
                return  redirect()->route('admin.movies.index');
            }

            $request['genre_id'] = $genre->id;
            unset($request['genre']);
            Movie::insert([$request->all()]);
            DB::commit();
            return redirect()->route('admin.movies.index');
        } catch(Exception $e) {
            DB::rollBack();
            abort(500);
        }
    }

    public function edit($id)
    {
        $movie = Movie::with('genre')->where('id', '=', $id)->first();

        return view('admin.edit', [
            'movie' => $movie
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|unique:movies',
            'image_url' => 'required|url',
            'published_year' => 'required',
            'is_showing' => 'required',
            'genre' => 'required',
            'description' => 'required'
        ]);


        try {
            DB::beginTransaction();

            unset($request['_token']);
            unset($request['_method']);

            $genre = Genre::where('name', '=', $request->genre)->first();

            if(empty($genre)) {
                Genre::insert([
                    ['name' => $request->genre]
                ]);

                $newGenre = Genre::orderBy('id', 'desc')->first();
                $request['genre_id'] = $newGenre->id;
                unset($request['genre']);
                Movie::where('id', '=', $id)->update($request->all());

                DB::commit();
                return  redirect()->route('admin.movies.index');
            }

            $request['genre_id'] = $genre->id;
            unset($request['genre']);
            Movie::where('id', '=', $id)->update($request->all());
            return redirect()->route('admin.movies.index');
        } catch(Exception $e) {
            DB::rollBack();
            abort(500);
        }
    }

    public function destroy($id)
    {
        $movie = Movie::where('id', '=', $id)->first();

        if(!empty($movie)) {
            Movie::where('id', '=', $id)->delete();

            return redirect()->route('admin.movies.index');
        } else {
            return App::abort(404);
        } 
    }
}
