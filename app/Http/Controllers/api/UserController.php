<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function register(Request $request)
  {
    $validation =Validator::make($request->all(),[
        'name' =>'required',
        'email' =>'required|unique:users',
        'password' =>'required|min:8|max:20',
    ]);
    if($validation->fails()){
      return $validation->errors();  
     }
        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return response()->json([
            'status'=>200,
            'data'=> $user
        ],200);
    
  }
  public function login(Request $request)
  { 
    $validation =Validator::make($request->all(),[
        'email' =>'required',
        'password' =>'required|min:8|max:20',
    ]);
    if($validation->fails()){
      return $validation->errors();  
     }
    $credentials = [
        'email'=> $request->email,
        'password'=>$request->password,
    ];
    
    if(Auth::attempt($credentials)){
        return response()->json(['status'=>200 , 'User' => $credentials],200);
    }
    return response()->json(['error'=>'user Not Found'],404);
  }
  public function postUser($id)
{
  return User::with('posts')->where('id',$id)->get();
}
}