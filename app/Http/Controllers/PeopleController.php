<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChildUser;
 use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileInfo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{

    /**
     * Handle the form submission to add a new person.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPerson(Request $request)
    {
       $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:child_users,username',
            'email' => 'nullable|email|max:255|unique:child_users,email',
            'password' => 'required|string|min:6',
        ]);



        try {
            $child_user = new ChildUser();
            $child_user->user_id = auth()->id();
            $child_user->name = $validatedData['name'];
            $child_user->username = $validatedData['username'];
            $child_user->email = $validatedData['email'];
            $child_user->password = bcrypt($validatedData['password']);
            $child_user->save();

            return redirect()->route('dashboard')->with('success', 'Person added successfully!');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {  // Specific code for a duplicate entry
                return back()->withInput()->withErrors(['email' => 'This email is already in use. Please choose another email.']);
            }
            throw $e;  // Rethrow the exception if it's not a known type
        }
    }

 public function show($id)
{
    $current_user_id = Auth::id();
    $childUser = ChildUser::find($id);

    if (!$childUser) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $profile_info = ProfileInfo::where('user_id', $current_user_id)->first();

    $files = Categories::where('child_id', $childUser->id)->get();

    $videoExtensions = ['mp4', 'mkv'];
    $photoExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];

    $videos = $files->filter(function ($file) use ($videoExtensions) {
        return in_array($file->file_type, $videoExtensions);
    });

    $images = $files->filter(function ($file) use ($photoExtensions) {
        return in_array($file->file_type, $photoExtensions);
    });

    $videoCount = $videos->count();
    $photoCount = $images->count();

    return view('child_profile', [
        'childUser' => $childUser, 
        'profile_info' => $profile_info, 
        'videoCount' => $videoCount, 
        'photoCount' => $photoCount,
        'videos' => $videos,
        'images' => $images
    ]);
}

public function deleteFile($id)
{
    $file = Categories::find($id);
    if ($file) {
        $filePath = public_path('uploads/' . $file->file);
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file from the server
        }
        $file->delete(); // Delete the record from the database
        return back()->with('success', 'File deleted successfully.');
    }

    return back()->with('error', 'File not found.');
}


    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|different:old_password',
            'confirm_password' => 'required|same:new_password',
        ]);
 
        
         
        $childUser = ChildUser::find($request->input('child_id'));

        dump( $childUser );


        if (!$childUser || !Hash::check($request->old_password, $childUser->password)) {
            return back()->withErrors(['error' => 'Your current password does not match our records.']);

        }

        $childUser->password = Hash::make($request->new_password);

        $childUser->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }



    public function delete(Request $request)
    {
        $childId = $request->input('child_id'); // Correctly retrieving child_id from request

        try {
            DB::beginTransaction();

            // Delete related videos first
            // VideoInfo::where('child_id', $childId)->delete(); // Removed extra dollar sign

            Conversation::where('child_id', $childId)->delete();

            // Correctly find the user by primary key
            $user = ChildUser::find($childId); // The find method should only take the primary key
            if ($user) {
                $user->delete();
                DB::commit();
                return redirect('/')->with('delete', 'Account and related videos deleted successfully.');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'User not found.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            // Optionally, log the exception message for debugging: Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the account.');
        }
    }
}
