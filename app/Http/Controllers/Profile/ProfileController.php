<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::with('roles')->get();
        return response()->json($profiles);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name_profile' => 'required',
            'description' => 'nullable',
            'roles' => 'array'
        ]);

        $profile = Profile::create($request->only('name_profile', 'description'));

        if ($request->roles) {
            $profile->roles()->attach($request->roles);
        }

        return response()->json($profile, 201);
    }

    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'name_profile' => 'sometimes|required',
            'description' => 'nullable',
            'roles' => 'array'
        ]);

        $profile->update($request->only('name_profile', 'description'));

        if ($request->roles) {
            $profile->roles()->sync($request->roles);
        }

        return response()->json($profile);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json(['message' => 'Profile deleted successfully.']);
    }
}
