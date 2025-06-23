<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $users = User::with('profiles')->get();
        return response()->json($users);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'document_id' => 'string|min:6|max:20',
            'direction' => 'string|min:6|max:50',
            'profiles' => 'array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->profiles) {
            $user->profiles()->attach($request->profiles);
        }

        // Enviar email de verificación
        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'User registered successfully. Please verify your email.',
            'user' => $user,
        ], 201);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'profiles' => 'array'
        ]);

        $user->update($request->only('name', 'email'));

        if ($request->profiles) {
            $user->profiles()->sync($request->profiles);
        }

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.']);
    }
}
