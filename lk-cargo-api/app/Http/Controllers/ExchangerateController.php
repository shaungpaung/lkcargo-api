<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exchangerate;

class ExchangerateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $exchangerate =  Exchangerate::all();
        return response()->json($exchangerate);
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
            'rate' => 'required',
            'created_on' => 'required',
        ]);
        $exchangerate = Exchangerate::create($validate);
        return response()->json($exchangerate);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $exchangerate =  Exchangerate::find($id);
        return response()->json($exchangerate);
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
        $exchangerate = Exchangerate::find($id);
        $validate = $request->validate([
            'rate' => 'required',
            'created_on' => 'required',
        ]);
        $exchangerate->update($validate);
        return response()->json(['message' => "Update Success!", 'type' => $exchangerate]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $exchangerate = Exchangerate::destroy($id);
        return response()->json(["Delete Success!"]);
    }
}
