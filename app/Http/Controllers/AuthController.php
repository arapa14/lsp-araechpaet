<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\City;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'successfully logged in');
        }

        return back()->with([
            'error' => 'The provided credentials do not match our records',
        ]);
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:18'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return redirect()->route('login')->with('success', 'successfully registered');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'successfully logged out');
    }

    public function dashboard(Request $request)
    {
        $user = Auth::user();

        // ======================
        // ADMIN
        // ======================
        if ($user->role === 'admin') {

            // ======================
            // BOOKING QUERY
            // ======================
            $bookingQuery = Booking::with([
                'user',
                'schedule.plane.airline',
                'schedule.origin',
                'schedule.destination',
                'payment'
            ]);

            // SEARCH
            if ($request->filled('search')) {
                $bookingQuery->where(function ($q) use ($request) {
                    $q->where('code', 'like', '%' . $request->search . '%')
                        ->orWhereHas('user', function ($q2) use ($request) {
                            $q2->where('name', 'like', '%' . $request->search . '%');
                        })
                        ->orWhereHas('schedule.plane.airline', function ($q2) use ($request) {
                            $q2->where('name', 'like', '%' . $request->search . '%');
                        });
                });
            }

            // FILTER STATUS
            if ($request->filled('status')) {
                $bookingQuery->where('status', $request->status);
            }

            $bookings = $bookingQuery->latest()
                ->paginate(10)
                ->withQueryString();

            // ======================
            // SCHEDULE (biarin aja / optional filter)
            // ======================
            $schedules = Schedule::with([
                'plane.airline',
                'origin',
                'destination'
            ])
                ->latest()
                ->paginate(10);

            return view('admin.dashboard', compact('bookings', 'schedules'));
        }

        // ======================
        // CUSTOMER
        // ======================
        $query = Schedule::with([
            'plane.airline',
            'origin',
            'destination'
        ]);

        // FILTER
        if ($request->filled('origin_id')) {
            $query->where('origin_id', $request->origin_id);
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('departure_time', $request->date);
        }

        // SEARCH (simple)
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

        // hanya tampilkan jadwal yang belum lewat
        $query->where('departure_time', '>', now());

        // PAGINATION + KEEP QUERY
        $schedules = $query->orderBy('departure_time')
            ->paginate(10)
            ->withQueryString();

        return view('customer.dashboard', [
            'schedules' => $schedules,
            'cities' => City::all(),
        ]);
    }
}
