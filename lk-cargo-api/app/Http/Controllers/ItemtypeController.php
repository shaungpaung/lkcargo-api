<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itemtype;

class ItemtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $type = Itemtype::all();
        return response()->json($type);
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
            'type' => 'required',
        ]);
        $type = Itemtype::create($validate);
        return response()->json($type);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $type = Itemtype::find($id);
        return response()->json(['message' => "Create Success!", 'type' => $type]);
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
        $type = Itemtype::find($id);
        $validate = $request->validate([
            'type' => 'required',
        ]);
        $type->update($validate);
        return response()->json(['message' => "Update Success!", 'type' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $type = Itemtype::destroy($id);
        return response()->json(["Delete Success!"]);
    }
}
