<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Othercharges;

class OtherchargesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $othercharges = OtherCharges::all();
        return response()->json($othercharges);
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
            'charge_type' => 'required',
            'qty' => 'required',
            'rate' => 'required',
        ]);
        $othercharges = Othercharges::create($validate);
        return response()->json($othercharges);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $othercharges = Othercharges::find($id);
        return response()->json($othercharges);
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
        $othercharges = Othercharges::find($id);
        $validate = $request->validate([
            'charge_type' => 'required',
            'qty' => 'required',
            'rate' => 'required',
        ]);
        $othercharges->update($validate);
        return response()->json(['message' => 'Successfully updated', 'data' => $othercharges]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $othercharges = OtherCharges::find($id);
        if (!$othercharges) {
            return response()->json(['message' => 'Charges Type id : ' . $id . ' not found'], 404);
        }
        $othercharges->delete();
        return response()->json(['message' => 'Charges Type delete success']);
    }
}
