<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // List view — Livewire component handles the data in Step 5
    public function index()
    {
        return view('appointments.index');
    }

    // Will be replaced by Livewire in Step 5
    public function store(Request $request)
    {
        $request->validate([
            'service_id'       => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        Appointment::create([
            'user_id'          => auth()->id(),
            'service_id'       => $request->service_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status'           => 'pending',
        ]);

        return back()->with('success', 'Appointment booked');
    }

    // Will be replaced by Livewire in Step 5
    public function cancel(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }
        $appointment->update(['status' => 'cancelled']);
        return back()->with('success', 'Appointment cancelled');
    }
}
