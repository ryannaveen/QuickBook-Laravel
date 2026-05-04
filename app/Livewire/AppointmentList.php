<?php

namespace App\Livewire;

use App\Models\Appointment;
use Illuminate\Support\Carbon;
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
        $this->successMessage = 'Appointment cancelled successfully.';
        $this->errorMessage   = '';
    }

    public function render()
    {
        $appointments = Appointment::with('service', 'service.owner')
            ->where('user_id', auth()->id())
            ->when($this->filterStatus !== 'all', fn($q) =>
                $q->where('status', $this->filterStatus)
            )
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->paginate(8);

        return view('livewire.appointment-list', compact('appointments'));
    }
}