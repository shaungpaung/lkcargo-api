<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::all();
        return response()->json($user);
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
            'user_name' => 'required',
            'staff_name' => 'required',
            'user_role' => ['required', Rule::in(config('enums.user_role'))],
            'branch' => ['required', Rule::in(config('enums.branch'))],
        ]);
        $user = User::create($validate);
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        return response()->json($user);
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
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User ' . $id . ' Not found'], 404);
        }
        $validate = $request->validate([
            'staff_name' => 'required',
            'user_role' => ['required', Rule::in(config('enums.user_role'))],
            'branch' => ['required', Rule::in(config('enums.branch'))]
        ]);
        $user->update($validate);
        return response()->json(['message' => 'Pet updated successfully', 'data' => $user]);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::destroy($id);
        $result = "Delete Success!";
        return response()->json($result);
    }
    public function login(Request $request)
    {
        $login = $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);
        $user = User::Where('user_name', $login["user_name"])->first();
        if (!$user) {
            return response()->json(['message' => "Username is not Found!", 422]);
        }
        if (!$user || !Hash::check($login["password"], $user->password)) {
            return response()->json(["message" => "Password is invalid", 422]);
        }
        $token = $user->createToken($login['user_name'])->plainTextToken;
        return response()->json([
            'user_name'  => $user,
            'token' => $token,
        ]);
    }

    public function resetPassword(Request $request)
    {
    }
}
