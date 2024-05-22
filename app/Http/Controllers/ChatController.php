<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChildUser;
use App\Models\User;
use App\Models\Categories;
use App\Models\Category;
use App\Models\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

   public function index(Request $request)
    {
        $allSessionData = $request->session()->all();
        $userData = $request->session()->get('childuser');
        $childuserInfo = null;
        $mainuserInfo = null;
        $uservideos = collect();
        $countVideo = 0;
        $conversation = null;

        if (empty($userData)) {
            return redirect('/login');
        }

        if (!empty($userData['id'])) {
            $childId = $userData['id'];
            $childuserInfo = ChildUser::find($childId);

            if ($childuserInfo) {
                $mainuserInfo = User::with('profileInfo')->find($childuserInfo->user_id);

                if (!$mainuserInfo) {
                    $mainuserInfo = null;
                }
            }

            $uservideos = Categories::where('child_id', $childId)->get();
            $countVideo = $uservideos->count();
        }

        return view('user_chat', compact('childuserInfo', 'mainuserInfo', 'allSessionData', 'uservideos', 'countVideo'));
    }


    public function userprofile(Request $request)
    {
        $allSessionData = $request->session()->all();
        $userData = $request->session()->get('childuser');
        $childuserInfo = null;
        $uservideos = collect();
        $countVideo = 0;

        if (!empty($userData['id'])) {
            $childuserInfo = ChildUser::find($userData['id']);

            // $uservideos = VideoInfo::where('child_id', $userData['id'])->get();
            $countVideo = $uservideos->count(); // No need to query the database again for the count
        }

        return view('profile.useredit', compact('childuserInfo', 'allSessionData', 'uservideos', 'countVideo'));
    }

    public function store(Request $request)
    {
        $childUser = ChildUser::findOrFail($request->user_id); // Ensure the user exists

        // Validation
        $validated = $request->validate([
            'cover_photo' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'profile' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'status' => 'required|string'
        ]);

        // Handling file uploads
        if ($request->hasFile('cover_photo')) {
            $coverPhotoPath = $request->file('cover_photo')->store('cover_photo', 'public');
            $childUser->cover_photo = $coverPhotoPath;
        }

        if ($request->hasFile('profile')) {
            $profilePhotoPath = $request->file('profile')->store('profile', 'public');
            $childUser->profile = $profilePhotoPath;
        }

        $childUser->name = $request->name;
        $childUser->email = $request->email;
        $childUser->status = $request->status;

        $childUser->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function fetchMessages(Request $request)
    {
        $allSessionData = $request->session()->all();
        $userData = $request->session()->get('childuser');

        $childuserInfo = null;
        $mainuserInfo = null;
        $messages = collect(); // Initialize an empty collection for messages

        if (!empty($userData['id'])) {
            $childuserInfo = ChildUser::find($userData['id']);
            
            if ($childuserInfo) {
                $mainuserInfo = User::with('profileInfo')->find($childuserInfo->user_id);
                if (!$mainuserInfo) {
                    $mainuserInfo = null;
                }
            }
        }

        if ($childuserInfo && $mainuserInfo) {
            $messages = Message::where('child_id', $childuserInfo->id)
                ->where('parent_id', $mainuserInfo->id)
                ->with('content')
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return response()->json([
            'messages' => $messages,
            'user_info' => $childuserInfo,
            'mainuser_info' => $mainuserInfo
        ]);
    }


public function sendMessage(Request $request)
{
    $current_child_id = $request->session()->get('childuser')['id'];
    $childUser = ChildUser::find($current_child_id);

    $mainUser =User::with('profileInfo')->find($childUser->user_id);

    if (!$childUser) {
        return response()->json(['error' => 'Child user not found'], 404);
    }

    $validated = $request->validate([
        'content' => 'required|string'
    ]);

    DB::beginTransaction();
    try {
        $content = trim($validated['content']);

        // Retrieve the category based on content or create it if not found
        $categoriesInfo = Categories::where('title', $content)
            ->where('child_id', $childUser->id)
            ->first();

        $matchFound = false;
        if ($categoriesInfo && strcasecmp($content, $categoriesInfo->title) == 0) {
            $matchFound = true;
        }

        // Create the new message
        $newMessage = Message::create([
            'child_id' => $childUser->id,
            'parent_id' => $childUser->user_id,
            'content_id' => $matchFound ? $categoriesInfo->id : null,
            'status' => 'sent',
        ]);

        // Prepare a response
        $response = [
            'sentTime' => now()->toDateTimeString(),
            'content' => $newMessage,
            'parentInfo' =>  $mainUser, // Assuming parentInfo relationship exists
            'answer' => $matchFound ? $categoriesInfo : 'No video available.'
        ];

        DB::commit();
        return response()->json($response);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => 'Failed to create message: ' . $e->getMessage()], 500);
    }
}

// public function sendMessage(Request $request)
// {
//     $current_child_id = $request->session()->get('childuser')['id'];

//     $childUser = ChildUser::find($current_child_id);
//     $parent_id = User::with('profileInfo')->find( $childUser->user_id);

//     $validated = $request->validate([
//         'content' => 'required|string'
//     ]);

//     DB::beginTransaction();
//     try {
//         $content = trim($validated['content']);

//         // Retrieve the category based on content or create it if not found
//         $categoriesInfo = Categories::where('content', $content)->first();
//         if (!$categoriesInfo) {
//             $categoriesInfo = Categories::create(['content' => $content]);
//         }

//         // Create the new message
//         $newMessage = Message::create([
//             'child_id' => $current_child_id,
//             'parent_id' => $parent_id,
//             'content_id' => $categoriesInfo->id,
//             'status' => 'sent',
//         ]);

//         // Check for content match
//         $matchFound = strcasecmp($content, $categoriesInfo->content) == 0;

//         // Prepare a response
//         $response = [
//             'sentTime' => now()->toDateTimeString(),
//             'content' => $newMessage,
//             'parentInfo' => $childUser,
//             'answer' => $matchFound ? $categoriesInfo->content : 'No video available.'
//         ];

//         DB::commit();
//         return response()->json($response);
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return response()->json(['error' => 'Failed to create message: ' . $e->getMessage()], 500);
//     }
// }





    public function user_logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
