<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * GET /api/services (PUBLIC)
     *
     * Returns a paginated list of services.
     * Supports optional ?search= query parameter to filter by
     * service_name or description.
     */
    public function index(Request $request)
    {
        $query = Service::with('owner');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('service_name', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }

        $services = $query->paginate(10);

        return ServiceResource::collection($services);
    }

    /**
     * GET /api/services/{service} (PUBLIC)
     *
     * Returns a single service by its ID (route model binding).
     */
    public function show(Service $service)
    {
        return new ServiceResource($service->load('owner'));
    }

    /**
     * POST /api/services (OWNER ONLY)
     *
     * Creates a new service for the authenticated owner.
     * Requires the 'services:manage' token ability.
     */
    public function store(Request $request)
    {
        if (! $request->user()->tokenCan('services:manage')) {
            return response()->json([
                'message' => 'Insufficient permissions',
            ], 403);
        }

        $data = $request->validate([
            'service_name'     => ['required', 'string', 'max:100'],
            'price'            => ['required', 'numeric', 'min:0'],
            'description'      => ['nullable', 'string', 'max:500'],
            'duration_minutes' => ['nullable', 'integer', 'min:15'],
        ]);

        $service = Service::create([
            ...$data,
            'owner_id' => auth()->id(),
        ]);

        return (new ServiceResource($service))
            ->response()
            ->setStatusCode(201);
    }
}
