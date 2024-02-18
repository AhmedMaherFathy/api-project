<?php

namespace Modules\Search\App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function searchUser(Request $request){
        if($request->search){
            $user = User::where('name','LIKE','%'.$request->search.'%')->get();
            return  response()->json(['data'=>$user, 'status' => Response::HTTP_FOUND]);
        }
        return  response()->json(['message'=>'NO RESULTS FOUND', 'status' => Response::HTTP_NOT_FOUND]);
    }
}
