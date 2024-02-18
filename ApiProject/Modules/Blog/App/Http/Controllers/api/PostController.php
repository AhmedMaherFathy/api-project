<?php

namespace Modules\Blog\App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Blog\App\Http\Requests\PostRequest;
use Modules\Blog\App\Http\Requests\updateRequest;
use Modules\Blog\App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts =Post::paginate(10);
        return response()->json([$posts, 'status' => Response::HTTP_OK ,'message'=>"All Posts"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('blog::create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();
        
        $saved = Post::create($validatedData);
        if ($saved){
            return response()->json(['data'=>$saved,'status'=> Response::HTTP_CREATED,'message'=>"Post saved successfully" ]);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $posts = Post::find($id);
        if($posts)
            return response()->json([$posts,'status'=> Response::HTTP_FOUND,'message'=>'post founded successfully']);
        
        return response()->json(['status'=> 404,'message'=>'post NOT founded']);
    }

    public function update(updateRequest $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['status'=> Response::HTTP_NOT_FOUND, 'message'=>'post NOT founded'] );
        }
        $validatedData = $request->validated();
        $post->update($validatedData);
        return response()->json([
            'data' => $post,
            'status' => Response::HTTP_OK,
            'message' => "Post updated successfully",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post){
            $post->delete();
            return response()->json(['status'=> Response::HTTP_OK , 'message'=>'post deleted'] );
        }
        return response()->json(['status'=> Response::HTTP_NOT_FOUND, 'message'=>'post NOT founded'] );
    }
}
