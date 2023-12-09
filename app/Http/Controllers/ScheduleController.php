<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Support\Facades\App;

class ScheduleController extends Controller
{
    public function create($id)
    {
        return  view('admin.schedule.create', [
            'id' => $id
        ]);
    }

    public function edit($id)
    {
        $schedule = Schedule::where('id', '=', $id)->first();
        
        return view('admin.schedule.edit', [
            'schedule' => $schedule
        ]);
    }

    public function store(CreateScheduleRequest $request, $id)
    {

        $start_date_time = $request->start_time_date . ' ' . $request->start_time_time;
        $end_date_time = $request->end_time_date . ' ' . $request->end_time_time;

        Schedule::insert([
            [
                'movie_id' => $request->movie_id,
                'start_time' => $start_date_time,
                'end_time' => $end_date_time
            ]
        ]);

        return redirect()->route('admin.movies.show', ['id' => $id]);
    }

    public function update(UpdateScheduleRequest $request, $id)
    {

        $start_date_time = $request->start_time_date . ' ' . $request->start_time_time;
        $end_date_time = $request->end_time_date . ' ' . $request->end_time_time;

        Schedule::where('id' , '=', $id)->update([
                'movie_id' => $request->movie_id,
                'start_time' => $start_date_time,
                'end_time' => $end_date_time
        ]);

        return redirect()->route('admin.movies.show', ['id' => $request->movie_id]);
    }

    public function destroy($id)
    {

        $schedule = Schedule::where('id', '=', $id)->first();
        
        if(!empty($schedule)) {
            Schedule::where('id', '=', $id)->delete();

            return redirect()->route('admin.movies.show', ['id' => $schedule->movie_id]);
        } else {
            return App::abort(404);
        } 
    }
}
