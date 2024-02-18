<?php

namespace Modules\Search\App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Blog\App\Models\Post;

class PostController extends Controller
{
    public function searchPost(Request $request){
        if($request->search){
            $posts = Post::where('content','LIKE','%'.$request->search.'%')->get();
            return  response()->json(['data' => $posts, 'status' => Response::HTTP_FOUND]);
        }
        return  response()->json(['message'=>'NO RESULTS FOUND', 'status' => Response::HTTP_NOT_FOUND]);
    }
}
