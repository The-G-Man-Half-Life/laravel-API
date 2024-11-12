<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return response()->json([], 204);
        }

        return response()->json($users, 200);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);


        $user = User::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => false, 
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        return response()->json($user, 201);
    }


    public function show(string $id)
    {
        $user = User::findOrFail($id);

        if ($user === null) {
            return response()->json([], 404);
        }

        return response()->json($user);
    }


    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $validatedData['name'] ?? $user->name,
            'last_name' => $validatedData['last_name'] ?? $user->last_name,
            'email' => $validatedData['email'] ?? $user->email,
            'password' => isset($validatedData['password']) ? Hash::make($validatedData['password']) : $user->password,
        ]);

        return response()->json($user);
    }


    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user==null) {
            return response()->json([], 404);
        }

        $user->delete();

        return response()->json(null, 204);
    }
}