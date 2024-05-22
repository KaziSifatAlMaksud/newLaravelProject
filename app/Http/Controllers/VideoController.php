<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
 public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,mkv|max:102400', // Maximum size of 100MB for any file
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            // Check if the file is valid
            if (!$file->isValid()) {
                return redirect()->back()->with('error', 'File upload failed. The file is not valid.');
            }

            // Check if the file is readable
            if (!is_readable($file->getPathname())) {
                return redirect()->back()->with('error', 'File upload failed. The file is not readable.');
            }

            $fileType = $file->getClientOriginalExtension();
            $filename = time() . '.' . $fileType;
            $destinationPath = public_path('/uploads');

            try {
                // Move the file to the destination path
                $file->move($destinationPath, $filename);
                $filePath = $filename; // Store only the filename
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to move uploaded file. Please check directory permissions.');
            }

            // Ensure the file exists before getting its size
            $fullFilePath = $destinationPath . DIRECTORY_SEPARATOR . $filename;

            if (!file_exists($fullFilePath)) {
                return redirect()->back()->with('error', 'Uploaded file is not found.');
            }

            // Check file size based on the file extension
            $fileSize = filesize($fullFilePath);
            
            if (in_array($fileType, ['mp4', 'mkv'])) {
                if ($fileSize > 100 * 1024 * 1024) { // 100MB
                    return redirect()->back()->with('error', 'Video files must be less than 100MB.');
                }
            } elseif (in_array($fileType, ['jpeg', 'jpg', 'png', 'gif', 'svg'])) {
                if ($fileSize > 3 * 1024 * 1024) { // 3MB
                    return redirect()->back()->with('error', 'Image files must be less than 3MB.');
                }
            }

            // Save to the categories table
            $category = new Categories();
            $category->title = $request->input('title');
            $category->description = $request->input('description');
            $category->file = $filePath; // Store the file path
            $category->file_type = $fileType;
             $category->parent_id  = Auth::user()->id;
            $category->child_id = $request->input('child_id');
            $category->status = 1; // Set status to true by default
           
            $category->save();

            return back()->with('success', 'File uploaded successfully.');
        }

        return back()->with('error', 'Please select a file to upload.');
    }
    // my autoload is ready
    public function autocomplete(Request $request)
    {
        $search = $request->input('term');
        $descriptions = Categories::where('title', 'LIKE', "%{$search}%")
            ->pluck('title');
        return response()->json($descriptions);
    }

     public function index()
    {
        return view('video');
    }
   public function videoupload(Request $request)
    {
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos', 'public');
            return response()->json(['path' => $path], 200);
        }
        return response()->json(['error' => 'No video uploaded'], 400);
    }

    public function videofile($filename)
    {
        $path = storage_path('app/public/videos/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function search(Request $request)
    {
        $description = $request->description;
        $video = VideoInfo::where('description', 'LIKE', "%{$description}%")->first();

        if ($video) {
            $imageTag = "<img src='/storage/videos/{$video->image}' alt='Video Image' />";
            return response()->json(['imageTag' => $imageTag]);
        } else {
            return response()->json(['imageTag' => 'No image found.']);
        }
    }
}
