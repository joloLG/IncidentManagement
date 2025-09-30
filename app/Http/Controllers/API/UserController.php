<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return ApiResponse::success($users);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return ApiResponse::created($user);
    }

    public function show(User $user)
    {
        return ApiResponse::success($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return ApiResponse::success($user);
    }

    public function destroy(User $user)
    {
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        
        $user->delete();
        return ApiResponse::success(null, 'Deleted', 204);
    }
}
