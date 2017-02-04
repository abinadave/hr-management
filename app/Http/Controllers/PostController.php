<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class PostController extends Controller
{
    public function createPost(){
    	echo "Hit in controller";
    }

    public function uploadFile(Request $request){
    	if ($request->hasFile('photo')) {
		    $file = $request->file('photo');
		    $filename = $file->getClientOriginalName();
		    Storage::put('temporary-files/'.$filename, file_get_contents($file));
		    return response()->json([
		    	'filename' => $filename
		    ]);
		}
    }

    public function fetchTempFiles(){
    	$files = Storage::files('temporary-files');
    	return $files;
    }
}
