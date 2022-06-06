<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Event;
use DateTimeZone;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $date = Carbon::now();
        
        // $startDayWeek = $date->startOfWeek()->format('Y-m-d');
        // $endDayWeek = $date->endOfWeek()->format('Y-m-d');
        
        $date = Carbon::now();

        $startDayMonth = $date->startOfMonth()->format('Y-m-d');
        $endDayMonth = $date->endOfMonth()->format('Y-m-d');

        // Event::whereBetween('reminder_date', [$startDayWeek, $endDayWeek])->get();

        return view('dashboard', [
            'events' => Event::where('user_id', auth()->id())->whereBetween('reminder_date', [$startDayMonth, $endDayMonth])->orderBy('reminder_date')->get(),
        ]);
    }
}
