<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SheetController extends Controller
{
    public function index(Request $request, $movieId, $scheduleId)
    {

        if(empty($request->date)) {
            return App::abort(400);
        }

        $sheets = Sheet::all();
        $sheetList = [];

        foreach($sheets as $sheet) {
            $sheetList[$sheet['row']][] = [
                'id' => $sheet['id'],
                'name' => $sheet['row'] . '-' . $sheet['column']
            ];
        }

        return view('user.sheet.index', [
            'sheetList' => $sheetList,
            'date' => $request->date,
            'movie_id' => $movieId,
            'schedule_id' => $scheduleId
        ]);
    }

    public function sheet()
    {
        $sheets = Sheet::all();
        $sheetList = [];

        foreach($sheets as $sheet) {
            $sheetList[$sheet['row']][] = [
                'id' => $sheet['id'],
                'name' => $sheet['row'] . '-' . $sheet['column']
            ];
        }

        return view('user.sheet.sheet', [
            'sheetList' => $sheetList
        ]);
    }
}
