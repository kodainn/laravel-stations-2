<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class MovieAdminController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        return view('admin.index', [
            'movies' => $movies
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
            'description' => 'required'
        ]);

        try {
            unset($request['_token']);
            Movie::insert([$request->all()]);
            return redirect()->route('admin.movies.index');
        } catch(Exception $e) {
            return redirect()
                    ->route('admin.movies.create')
                    ->with('flash_message', '登録に失敗しました。');
        }
    }

    public function edit($id)
    {
        $movie = Movie::where('id', '=', $id)->first();

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
            'description' => 'required'
        ]);

        try {
            unset($request['_token']);
            unset($request['_method']);
            Movie::where('id', '=', $id)->update($request->all());
            return redirect()->route('admin.movies.index');
        } catch(Exception $e) {
            return redirect()
                    ->route('admin.movies.edit', [
                        'id' => $id
                    ])
                    ->with('flash_message', '更新に失敗しました。');
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
