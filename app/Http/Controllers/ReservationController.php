<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminReservationRequest;
use App\Models\Reservation;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReservationController extends Controller
{
    public function create(Request $request, $movieId, $schduleId)
    {

        if(empty($request->date) || empty($request->sheetId)) {
            return App::abort(400);
        }

        //クエリパラメータを変えてアクセスしたときに予約済みであったら。
        $search = [
            ['schedule_id', '=', $schduleId],
            ['sheet_id', '=', $request->sheetId]
        ];
        if(Reservation::where($search)->exists()) {
            return App::abort(400);
        }

        return view('user.reservation.create', [
            'movie_id' => $movieId,
            'schedule_id' => $schduleId,
            'sheet_id' => $request->sheetId,
            'date' => $request->date
        ]);
    }

    public function store(CreateAdminReservationRequest $request)
    {
        $search = [
            ['schedule_id', '=', $request->schedule_id],
            ['sheet_id', '=', $request->sheet_id]
        ];

        if(Reservation::where($search)->exists()) {
            return redirect()->route('movies.index');
        }

        Reservation::create([
            'date' => $request->date,
            'schedule_id' => $request->schedule_id,
            'sheet_id' => $request->sheet_id,
            'email' => $request->email,
            'name' => $request->name,
            'is_canceled' => false
        ]);

        return redirect()->route('movies.index');
    }
}
