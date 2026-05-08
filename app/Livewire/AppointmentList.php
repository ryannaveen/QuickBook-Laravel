<?php

namespace App\Livewire;

use App\Mail\AppointmentCancelled;
use App\Models\Appointment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class AppointmentList extends Component
{
    use WithPagination;

    public string $filterStatus    = 'all';
    public string $successMessage  = '';
    public string $errorMessage    = '';

    public function updatingFilterStatus(): void
    {
        $this->resetPage();
    }

    public function cancel(int $appointmentId): void
    {
        $appointment = Appointment::where('id', $appointmentId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $appointmentDateTime = Carbon::parse(
            $appointment->appointment_date . ' ' . $appointment->appointment_time
        );

        if (Carbon::now()->diffInMinutes($appointmentDateTime, false) < 60) {
            $this->errorMessage   = 'Cannot cancel an appointment within 1 hour of its scheduled time.';
            $this->successMessage = '';
            return;
        }

        $appointment->update(['status' => 'cancelled']);

        $appointment->load('service.owner');

        Mail::to(auth()->user()->email)
            ->send(new AppointmentCancelled($appointment));

        $this->successMessage = 'Appointment cancelled successfully.';
        $this->errorMessage   = '';
    }

    public function render()
    {
        $appointments = Appointment::with('service', 'service.user')
            ->where('user_id', auth()->id())
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->get();

        return view('livewire.appointment-list', compact('appointments'));
    }
}