<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ManageServices extends Component
{
    use WithPagination;

    public bool    $showForm     = false;
    public bool    $isEditing    = false;
    public ?int    $editingId    = null;

    public string  $service_name = '';
    public string  $price        = '';
    public string  $description  = '';
    public string  $duration     = '60';

    public string  $successMessage = '';

    public function openCreate(): void
    {
        $this->resetForm();
        $this->showForm  = true;
        $this->isEditing = false;
    }

    public function openEdit(int $serviceId): void
    {
        $service = Service::where('id', $serviceId)
            ->where('owner_id', auth()->id())
            ->firstOrFail();

        $this->editingId    = $serviceId;
        $this->service_name = $service->service_name;
        $this->price        = $service->price;
        $this->description  = $service->description ?? '';
        $this->duration     = $service->duration_minutes ?? '60';
        $this->isEditing    = true;
        $this->showForm     = true;
    }

    public function save(): void
    {
        $this->validate([
            'service_name' => 'required|string|max:100',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string|max:500',
            'duration'     => 'required|integer|min:15|max:480',
        ]);

        if ($this->isEditing) {
            Service::where('id', $this->editingId)
                ->where('owner_id', auth()->id())
                ->update([
                    'service_name'     => $this->service_name,
                    'price'            => $this->price,
                    'description'      => $this->description,
                    'duration_minutes' => $this->duration,
                ]);
            $this->successMessage = 'Service updated successfully.';
        } else {
            Service::create([
                'owner_id'         => auth()->id(),
                'service_name'     => $this->service_name,
                'price'            => $this->price,
                'description'      => $this->description,
                'duration_minutes' => $this->duration,
            ]);
            $this->successMessage = 'Service created successfully.';
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $serviceId): void
    {
        Service::where('id', $serviceId)
            ->where('owner_id', auth()->id())
            ->delete();

        $this->successMessage = 'Service deleted.';
        $this->resetPage();
    }

    public function cancelForm(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->service_name = '';
        $this->price        = '';
        $this->description  = '';
        $this->duration     = '60';
        $this->editingId    = null;
        $this->isEditing    = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        $services = Service::where('owner_id', auth()->id())
            ->withCount('appointments')
            ->latest()
            ->paginate(8);

        return view('livewire.manage-services', compact('services'));
    }
}