<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ChildUser;
use App\Models\ProfileInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile_info = ProfileInfo::where('user_id', $user->id)->first();

        return view('profile.edit', ['user' => $user,  'profile_info' => $profile_info]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'gender' => 'required|in:M,F,O',
            'country' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB Max
        ]);

        // Retrieve authenticated user
        $user = Auth::user();

        // Prepare data for profile info
        $profileData = [
            'user_id' => $user->id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'country' => $request->country,
            'bio' => $request->bio,
        ];

        if ($request->hasFile('image')) {
            // Retrieve current profile to check for existing images
            $currentProfile = ProfileInfo::where('user_id', $user->id)->first();

            // Delete old image if exists
            if ($currentProfile && $currentProfile->profile_image) {
                Storage::disk('public')->delete($currentProfile->profile_image); // Ensure you use the correct disk
            }
            $profileData['image'] = $request->file('image')->store('profile_images', 'public');
        }


        // Update or create profile info
        $profileInfo = ProfileInfo::updateOrCreate(['user_id' => $user->id], $profileData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
