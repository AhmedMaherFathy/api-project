<?php

namespace Modules\Auth\App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\App\Http\Requests\AuthRequest;
use Modules\Blog\App\Models\Post;

class AuthController extends Controller
{
    public function register(AuthRequest $request){
        $data = $request->validated();
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  bcrypt($data['password']),
        ]);

        if ($user->save()) {
            return response()->json(['message'=>'successfully registered','data'=>$user,'status'=>Response::HTTP_CREATED]);
        }
        return response()->json(['message'=>'Failed','status'=>404]);
        
    }
    public function logIn(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') 
                return response()->json(['message'=>'successful login admin','data'=>$user,'status'=>Response::HTTP_ACCEPTED]);
            
            return response()->json(['message'=>'successful login','data'=>$user,'status'=>Response::HTTP_ACCEPTED]);
        }
        else
        {
            return response()->json(['message'=>'NOt a User','status'=>Response::HTTP_NON_AUTHORITATIVE_INFORMATION]);
        }
    }
    public function logout(){
        Auth::logout();
        return response()->json(['message'=>'logout successfully','status'=>Response::HTTP_OK]);
    }
}
