<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Post as Post;
class PostController extends Controller
{
    public function createPost(Request $request){
    	// $post = new Post;
        $this->validate($request, [
            'title' => 'required|unique:posts',
            'body'  => 'required'
        ]);
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return $this->saveTempFiles($post);
    }
    
    private function saveTempFiles($post){
        $files = Storage::files('temporary-files');
        foreach ($files as $key => $file) {
            $arr = explode("/", $file);
            $directory = 'post-files/' . $post->id;
            Storage::makeDirectory($directory);
            Storage::move($file, $directory . '/' .$arr[1]);
        }
        return $post;
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
