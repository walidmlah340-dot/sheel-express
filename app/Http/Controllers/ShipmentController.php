<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    public function create()
    {
        return view('shipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup_address' => ['required','string','min:3','max:255'],
            'dropoff_address' => ['required','string','min:3','max:255'],
            'package_desc' => ['nullable','string','max:255'],
            'weight' => ['nullable','numeric','min:0'],
            'cod_amount' => ['nullable','numeric','min:0'],
        ]);

        $shipment = Shipment::create([
            'customer_id' => Auth::id(),
            'pickup_address' => $request->pickup_address,
            'dropoff_address' => $request->dropoff_address,
            'package_desc' => $request->package_desc,
            'weight' => $request->weight ?? 0,
            'cod_amount' => $request->cod_amount ?? 0,
            'status' => 'new',
        ]);

        return redirect()->route('shipments.show', $shipment);
    }

    public function show(Shipment $shipment)
    {
        abort_unless($shipment->customer_id === Auth::id(), 403);
        return view('shipments.show', compact('shipment'));
    }
}

