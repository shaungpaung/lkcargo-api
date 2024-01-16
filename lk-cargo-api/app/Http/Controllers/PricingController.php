<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pricings;

class PricingController extends Controller
{
    protected $queryWith = ['itemtype'];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $queryBuilder = Pricings::orderBy('qty');
        if ($request->has('type_id')) {
            $queryBuilder->where('type_id', $request->type_id);
        }
        if ($request->has('query_with')) {
            $query_with = explode(',', $request->query_with);
            $queryBuilder->with($query_with);
        }
        $pricing = $queryBuilder->get();
        return response()->json($pricing);
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
            'qty' => 'required',
            'rate' => 'required',
            'created_on' => 'required',
            'type_id' => 'required|exists:App\Models\ItemType,id',
        ]);
        $pricing = Pricings::create($validate);
        return response()->json($pricing);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pricing = Pricings::with($this->queryWith)->find($id);

        if (!$pricing) {
            return response()->json(['message' => 'Pricing not found'], 404);
        }

        return response()->json($pricing);
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
        $pricing = Pricings::find($id);
        $validate = $request->validate([
            'qty' => 'required',
            'rate' => 'required',
            'created_on' => 'required',
            'type_id' => 'required|exists:App\Models\ItemType,id',
        ]);
        $pricing->update($validate);
        return response()->json(Pricings::with($this->queryWith)->find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pricing = Pricings::with($this->queryWith)->find($id);
        if (!$pricing) {
            return response()->json(['message' => 'Pricing not found'], 404);
        }
        $pricing->delete();
        return response()->json(['message' => 'Pricing deleted successfully']);
    }
}
