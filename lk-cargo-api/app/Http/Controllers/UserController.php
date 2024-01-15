<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


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
        if (!Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized. Only admin can create user'], 403);
        }
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
        if (!Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized. Only admin can update user'], 403);
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
        if (!Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized. Only admin can delete user'], 403);
        }
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
            'login_user'  => $user,
            'token' => $token,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:App\Models\User,id'
        ]);
        $user = User::find($validated['user_id']);
        $user->update([
            'password' => Hash::make('12345')
        ]);
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Successfully reset password.'
        ]);
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:App\Models\User,id',
            'old_password' => 'required',
            'new_password' => 'required',
            'confirmed_password' => 'required | same:new_password'
        ]);
        $user = User::find($validated['user_id']);
        if (!Hash::check($validated['old_password'], $user->password)) {
            return response()->json(['message' => "Old password is invalid."], 422);
        }
        $user->update([
            'password' => Hash::make($validated["new_password"])
        ]);
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Successfully changed to new password.'
        ]);
    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => "Successfully logged out"]);
        }
        return response()->json(['message' => 'Unauthorized.'], 401);
    }
}
