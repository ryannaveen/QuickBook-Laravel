<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Client view - browse all services
    public function index()
    {
        return view('services.index');
    }

    // Owner view - manage their services
    public function ownerIndex()
    {
        return view('services.manage');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:100',
            'price'        => 'required|numeric|min:0',
        ]);

        Service::create([
            'owner_id'     => auth()->id(),
            'service_name' => $request->service_name,
            'price'        => $request->price,
        ]);

        return back()->with('success', 'Service created.');
    }
}