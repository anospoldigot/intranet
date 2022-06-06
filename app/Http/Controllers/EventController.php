<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Message;
use DateTime;
use Illuminate\Support\Carbon;
use helperdate;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        Message::where('user_id', auth()->id())->get();

        return view('event.index');
    }

    // public function index(Request $request)
    // {
    // }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'add') {
                $event = Event::create([
                    'user_id' => auth()->id(),
                    'title'        =>    $request->title,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end
                ]);

                return response()->json($event);
            }

            if ($request->type == 'update') {
                $event = Event::find($request->id)->update([
                    'user_id' => auth()->id(),
                    'title'        =>    $request->title,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end
                ]);

                return response()->json($event);
            }

            if ($request->type == 'delete') {
                $event = Event::find($request->id)->delete();

                return response()->json($event);
            }
        }
    }

    public function create()
    {
        return view('event.create');
    }

    public function store()
    {

        $data = [];

        foreach (request('days') as $key => $day) {
            $date = helperdate::getDateByDayInWeek(request('start'), $day);

            $startDate = $date['startDate'];
            $reminderDate = $date['reminderDate'];
            $endDate = $date['endDate'];


            $start = strtotime(request('start'));
            $end = strtotime(request('end'));

            while ($start <= $end) {

                $data[] = [
                    'user_id' => auth()->id(),
                    'title' => request('title'),
                    'description' => request('description'),
                    'start' => $startDate,
                    'reminder_date' => $reminderDate,
                    'end' => $endDate
                ];

                $date = new Carbon($startDate);
                $startDate = $date->addDays('7');
                $date = new Carbon($reminderDate);
                $reminderDate = $date->addDays('7');
                $date = new Carbon($endDate);
                $endDate = $date->addDays('7');
                $start = strtotime($startDate);
            }
        }

        if (count($data) > 0) {
            Event::upsert($data, ['title', 'description', 'start', 'end']);
        }


        session()->flash('success', 'Berhasil menambahkan event');

        return back();
    }
}
