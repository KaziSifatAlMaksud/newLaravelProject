<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChildUser;
use App\Models\ProfileInfo;
use App\Events\UserLoggedIn;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function dashboard(Request $request)
    {
        $current_user_id = Auth::id();

        // Ensure the custom scope is defined in the ProfileInfo model
        $profile_info = ProfileInfo::where('user_id', $current_user_id)->first();
        $childUsers = ChildUser::where('user_id', $current_user_id)
            // ->with('videoinfo')
            // ->withCount('videoinfo')
            ->get();


        $countchildUsers = ChildUser::where('user_id', $current_user_id)->count();
        // $countVideo = VideoInfo::where('user_id', $current_user_id)->count();


        // Passing data to the view
        return view('dashboard', [
            'user' => $request->user(),
            'profile_info' => $profile_info,
            'countchildUsers' => $countchildUsers,
            // 'countVideo' => $countVideo,
            'childUsers' => $childUsers
        ]);
    }


    /**
     * Show the user login form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function user_login(Request $request)
    {
        return view('user_auth.user_login');
    }


    public function subscription(){
           return view('payment_getway'); 
    }

    public function validateUserEntry(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $childUser = ChildUser::where('email', $validatedData['email'])->first();
        if ($childUser && Hash::check($validatedData['password'], $childUser->password)) {
            // Store user data into session
            $request->session()->put('childuser', [
                'id' => $childUser->id,
                'email' => $childUser->email,
                'name' => $childUser->name, // assuming the user model has a name
            ]);
            return redirect()->route('chat');

            // Option 2: Directly pass data to a view
            // return view('user_chat', ['childuser' => $request->session()->get('childuser')]);
        } else {
            return back()->withErrors(['error' => 'The provided credentials do not match our records.']);
        }
    }

    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        // Simulate a search in your database, you might want to use Eloquent to search
        $childUser = ChildUser::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->first();

        if ($childUser) {
            return response()->json([
                'email' => $childUser->email,
                'name' => $childUser->name
            ]);
        } else {
            return response()->json([
                'email' => '',
                'name' => ''
            ], 404);
        }
    }
}
