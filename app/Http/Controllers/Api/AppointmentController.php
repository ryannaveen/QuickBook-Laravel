<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * GET /api/appointments
     *
     * Returns the authenticated user's appointments, paginated.
     * Requires the 'appointments:read' token ability.
     * Supports optional ?status= filter.
     */
    public function index(Request $request)
    {
        if (! $request->user()->tokenCan('appointments:read')) {
            return response()->json([
                'message' => 'Insufficient permissions',
            ], 403);
        }

        $query = Appointment::with(['service', 'service.owner'])
            ->where('user_id', $request->user()->id);

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $appointments = $query->paginate(10);

        return response()->json($appointments);
    }

    /**
     * POST /api/appointments
     *
     * Creates a new appointment for the authenticated user.
     * Requires the 'appointments:create' token ability.
     * Enforces a minimum 1-hour advance booking and no scheduling conflicts.
     */
    public function store(Request $request)
    {
        if (! $request->user()->tokenCan('appointments:create')) {
            return response()->json([
                'message' => 'Insufficient permissions',
            ], 403);
        }

        $data = $request->validate([
            'service_id'       => ['required', 'exists:services,id'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => ['required', 'date_format:H:i'],
        ]);

        // 1-hour advance booking check
        $dt = Carbon::parse($data['appointment_date'] . ' ' . $data['appointment_time']);

        if ($dt->diffInMinutes(Carbon::now(), false) >= 0 || $dt->diffInMinutes(Carbon::now()) < 60) {
            if ($dt->lessThan(Carbon::now()->addMinutes(60))) {
                return response()->json([
                    'message' => 'Appointments must be booked at least 1 hour in advance.',
                ], 422);
            }
        }

        // Conflict check: same service, same date, overlapping time, not cancelled
        $conflict = Appointment::where('service_id', $data['service_id'])
            ->where('appointment_date', $data['appointment_date'])
            ->where('appointment_time', $data['appointment_time'])
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($conflict) {
            return response()->json([
                'message' => 'This time slot is already booked. Please choose another time.',
            ], 422);
        }

        $appointment = DB::transaction(function () use ($data, $request) {
            return Appointment::create([
                ...$data,
                'user_id' => $request->user()->id,
                'status'  => 'pending',
            ]);
        });

        return response()->json($appointment->load(['service', 'service.owner']), 201);
    }

    /**
     * PATCH /api/appointments/{appointment}/cancel
     *
     * Cancels an appointment belonging to the authenticated user.
     * Prevents cancellation if the appointment is less than 1 hour away.
     */
    public function cancel(Request $request, Appointment $appointment)
    {
        // Ownership check — never expose other users' data
        if ($appointment->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You are not authorised to cancel this appointment.',
            ], 403);
        }

        // 1-hour cancellation protection
        $dt = Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);

        if ($dt->lessThan(Carbon::now()->addMinutes(60))) {
            return response()->json([
                'message' => 'Appointments cannot be cancelled less than 1 hour before the scheduled time.',
            ], 422);
        }

        $appointment->update(['status' => 'cancelled']);

        return response()->json($appointment->fresh()->load(['service', 'service.owner']));
    }
}
