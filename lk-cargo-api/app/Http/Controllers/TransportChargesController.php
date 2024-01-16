<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransportCharges;
use Illuminate\Validation\Rule;

class TransportChargesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transport_type = TransportCharges::all();
        return response()->json($transport_type);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'transport_type' => 'required',
            'branch' => ['required', Rule::in(config('enums.branch'))],
            'qty' => 'required',
            'price' => 'required',
        ]);
        $transport_type = TransportCharges::create($validate);
        return response()->json($transport_type);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $transport_type = TransportCharges::find($id);
        return response()->json($transport_type);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $transport_type = TransportCharges::find($id);
        $validate = $request->validate([
            'transport_type' => 'required',
            'branch' => ['required', Rule::in(config('enums.branch'))],
            'qty' => 'required',
            'price' => 'required',
        ]);
        $transport_type->update($validate);
        return response()->json(['message' => 'Successfully updated', 'data' => $transport_type]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $transport_type = TransportCharges::find($id);
        if (!$transport_type) {
            return response()->json(['message' => 'Transportation Charges id : ' . $id . ' not found'], 404);
        }
        $transport_type->delete();
        return response()->json(['message' => 'Transportation Charges delete success']);
    }
}
