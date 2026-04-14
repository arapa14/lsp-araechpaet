<?php

namespace App\Http\Controllers\admin;

use App\Models\Schedule;
use App\Models\Plane;
use App\Models\City;
use Illuminate\Http\Request;

class ScheduleController
{

    public function index(Request $request)
    {
        $query = Schedule::with([
            'plane.airline',
            'origin',
            'destination'
        ]);

        // 🔍 SEARCH (airline / plane)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('plane.airline', function ($q2) use ($request) {
                    $q2->where('name', 'like', '%' . $request->search . '%');
                })
                    ->orWhereHas('plane', function ($q2) use ($request) {
                        $q2->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // 🎯 FILTER (origin, destination, date)
        if ($request->filled('origin_id')) {
            $query->where('origin_id', $request->origin_id);
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('departure_time', $request->date);
        }

        $schedules = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.schedule.index', [
            'schedules' => $schedules,
            'cities' => City::all(),
        ]);
    }

    public function create()
    {
        return view('admin.schedule.create', [
            'planes' => Plane::with('airline')->get(),
            'cities' => City::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'origin_id' => 'required|exists:cities,id|different:destination_id',
            'destination_id' => 'required|exists:cities,id',
            'departure_time' => 'required|date|after:now',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|integer|min:0',
            'available_seats' => 'required|integer|min:1',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedule.index')
            ->with('success', 'Schedule created');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);

        return view('admin.schedule.edit', [
            'schedule' => $schedule,
            'planes' => Plane::with('airline')->get(),
            'cities' => City::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'plane_id' => 'required|exists:planes,id',
            'origin_id' => 'required|exists:cities,id|different:destination_id',
            'destination_id' => 'required|exists:cities,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|integer|min:0',
            'available_seats' => 'required|integer|min:0',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('schedule.index')
            ->with('success', 'Schedule updated');
    }


    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return back()->with('success', 'Schedule deleted');
    }
}
