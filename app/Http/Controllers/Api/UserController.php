<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        if($users->count() > 0) {
            return response()->json($users,200);
        }

        return response()->json(['message' => 'No users found'],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'first_time' => 'boolean',
            'active' => 'boolean',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $imagePath = null;
        if($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user = User::create([
            'name'=> $request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password),
            'first_time' => $request->first_time ?? true,
            'active' => $request->active ?? true,
            'profile_image_path' => $imagePath,
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'profile_image_url' => $imagePath ? asset("storage/$imagePath") : null,
        ], 201);
    }
    public function show(User $user)
    {
        $user->profile_image_url = $user->profile_image_path ? asset("storage/{$user->profile_image_path}") : null;
        return response()->json($user, 200);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'first_time' => 'required|boolean',
            'active' => 'required|boolean',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image_path) {
                Storage::disk('public')->delete($user->profile_image_path);
            }

            $user->profile_image_path = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user->update(array_merge(
            $request->only(['name', 'email', 'first_time', 'active']),
            $request->filled('password') ? ['password' => Hash::make($request->password)] : []
        ));

        $user->refresh();
        $user->profile_image_url = $user->profile_image_path ? asset("storage/{$user->profile_image_path}") : null;

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);
    }

    public function destroy(User $user)
    {
        if ($user->profile_image_path) {
            Storage::disk('public')->delete($user->profile_image_path);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ], 200);
    }
}



