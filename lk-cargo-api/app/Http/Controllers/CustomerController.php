<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customer = Customer::all();
        return response()->json($customer);
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
            'name' => 'required',
            'type' => ['required', Rule::in(config('enums.type'))],
            'nrc'  => 'required',
            'phone' => 'required',
            'phone_number' => 'nullable',
            'address' => 'required',
            'business_name' => 'nullable',
            'payment_type' => ['required', Rule::in(config('enums.payment_type'))]
        ]);
        $customer = Customer::create($validate);
        return response()->json($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer id:' . $id . ' not found'], 404);
        }
        return response()->json($customer);
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
        $customer = Customer::find($id);
        $validate = $request->validate([
            'name' => 'required',
            'type' => ['required', Rule::in(config('enums.type'))],
            'nrc'  => 'required',
            'phone' => 'required',
            'phone_number' => 'nullable',
            'address' => 'required',
            'business_name' => 'nullable',
            'payment_type' => ['required', Rule::in(config('enums.payment_type'))]
        ]);
        $customer->update($validate);
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer id:' . $id . ' not found'], 404);
        }
        $customer->delete();
        $result = 'Delete successful';
        return response()->json($result);
    }
}
