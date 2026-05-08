<?php

namespace App\Livewire;

use App\Mail\AppointmentBooked;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceBrowser extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortBy = 'service_name';

    public bool $showModal       = false;
    public ?int $selectedService = null;
    public string $serviceName   = '';
    public string $servicePrice  = '';

    public string $appointmentDate = '';
    public string $appointmentTime = '';

    public string $bookingError   = '';
    public bool   $bookingSuccess = false;
    public bool   $loading        = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openBooking(int $serviceId): void
    {
        $service = Service::findOrFail($serviceId);

        $this->selectedService = $serviceId;
        $this->serviceName     = $service->service_name;
        $this->servicePrice    = $service->price;
        $this->appointmentDate = '';
        $this->appointmentTime = '';
        $this->bookingError    = '';
        $this->bookingSuccess  = false;
        $this->showModal       = true;
    }

    public function closeModal(): void
    {
        $this->showModal       = false;
        $this->selectedService = null;
        $this->bookingError    = '';
        $this->bookingSuccess  = false;
    }

    public function updated(string $field): void
    {
        if (in_array($field, ['appointmentDate', 'appointmentTime'])) {
            $this->bookingError = '';
            $this->validateOnly($field, $this->validationRules());
        }
    }

    public function book(): void
    {
        $this->bookingError = '';
        $this->loading      = true;

        $this->validate($this->validationRules());

        $appointmentDateTime = Carbon::parse(
            $this->appointmentDate . ' ' . $this->appointmentTime
        );

        if ($appointmentDateTime->isPast()) {
            $this->bookingError = 'Please select a future date and time.';
            $this->loading      = false;
            return;
        }

        if ($appointmentDateTime->diffInMinutes(Carbon::now(), false) > -60) {
            $this->bookingError = 'Appointments must be booked at least 1 hour in advance.';
            $this->loading      = false;
            return;
        }

        $slotEnd = $appointmentDateTime->copy()->addHour();

        $conflict = Appointment::where('service_id', $this->selectedService)
            ->where('status', '!=', 'cancelled')
            ->where('appointment_date', $this->appointmentDate)
            ->where(function ($q) use ($appointmentDateTime, $slotEnd) {
                $q->whereRaw("ADDTIME(appointment_time, '01:00:00') > ?", [$appointmentDateTime->format('H:i:s')])
                  ->whereRaw("appointment_time < ?", [$slotEnd->format('H:i:s')]);
            })
            ->exists();

        if ($conflict) {
            $this->bookingError = 'This time slot is already booked. Please choose another time.';
            $this->loading      = false;
            return;
        }

        $duplicate = Appointment::where('user_id', auth()->id())
            ->where('service_id', $this->selectedService)
            ->where('appointment_date', $this->appointmentDate)
            ->where('appointment_time', $this->appointmentTime)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($duplicate) {
            $this->bookingError = 'You already have a booking for this time slot.';
            $this->loading      = false;
            return;
        }

        \DB::transaction(function () {
            $appointment = Appointment::create([
                'user_id'          => auth()->id(),
                'service_id'       => $this->selectedService,
                'appointment_date' => $this->appointmentDate,
                'appointment_time' => $this->appointmentTime,
                'status'           => 'pending',
            ]);

            $appointment->load('service.owner');

            Mail::to(auth()->user()->email)
                ->send(new AppointmentBooked($appointment));
        });

        $this->bookingSuccess = true;
        $this->loading        = false;
    }

    public function render()
    {
        $services = Service::query()
            ->with('owner')
            ->when($this->search, fn($q) =>
                $q->where('service_name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
            )
            ->orderBy($this->sortBy)
            ->paginate(6);

        return view('livewire.service-browser', compact('services'));
    }

    private function validationRules(): array
    {
        return [
            'appointmentDate' => ['required', 'date', 'after_or_equal:today'],
            'appointmentTime' => ['required', 'date_format:H:i'],
        ];
    }
}