<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminReservationRequest;
use App\Http\Requests\UpdateAdminReservationRequest;
use App\Models\Reservation;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('date', '>' , Carbon::now())
                    ->with('sheet')
                    ->get();

        return view('admin.reservation.index', [
            'reservations' => $reservations
        ]);
    }

    public function create()
    {
        return view('admin.reservation.create');
    }

    public function store(CreateAdminReservationRequest $request)
    {
        
        $schedule = Schedule::where('id', '=', $request->schedule_id)->first();

        Reservation::create([
            'schedule_id' => $request->schedule_id,
            'sheet_id' => $request->sheet_id,
            'name' => $request->name,
            'email' => $request->email,
            'date' => $schedule->start_time->format('Y-m-d')
        ]);

        return redirect()->route('admin.reservations.index');
    }

    public function edit($id)
    {
        $reservation = Reservation::with('schedule')->where('id', '=', $id)->first();

        return view('admin.reservation.edit', [
            'reservation' => $reservation
        ]);
    }

    public function update(UpdateAdminReservationRequest $request, $id)
    {
        $schedule = Schedule::where('id', '=', $request->schedule_id)->first();

        Reservation::where('id', '=', $id)->update([
            'schedule_id' => $request->schedule_id,
            'sheet_id' => $request->sheet_id,
            'name' => $request->name,
            'email' => $request->email,
            'date' => $schedule->start_time->format('Y-m-d')
        ]);

        return redirect()->route('admin.reservations.index');
    }

    public function destroy($id)
    {
        if(!(Reservation::where('id', '=', $id)->exists())) {
            return abort(404);
        }

        Reservation::where('id', '=', $id)->delete();

        return redirect()->route('admin.reservations.index');
    }
}
