<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login' , 'register']]);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email',
            'password' => 'required',
            'secret_key' => 'required'
        ]);
        
        
        if($request->secret_key != 'nlet123'){
            return response()->json(['error'=>'Unautorized Secret Key'] , 201);
            
        }
        else{
        $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
        
            $user->save();
        return response()->json(['success'=>'data saved successfully'] , 201);
        }
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        return $this->createNewToken($token);
    }

    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function profile(){
        return response()->json(auth()->user());
    }

    
    public function logout(){
        auth()->logout();
        return response()->json(['message'=>'User logout successfully']);

    }
    
    public function candidate(Request $request){

        if(auth()->user()){
            return response()->json(['message'=>'Message to be displayed']);
        }
        else{
            return response()->json(['error'=>'Unauthorized You Bitch']);

        }

        // $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|string|email',
        //     'password' => 'required',
        //     'secret_key' => 'required'
        // ]);
        
        
        // if($request->secret_key != 'nlet123'){
        //     return response()->json(['error'=>'Unautorized Secret Key'] , 201);
            
        // }
        // else{
        // $user = new User();
        //     $user->name = $request->name;
        //     $user->email = $request->email;
        //     $user->password = Hash::make($request->password);
        
        //     $user->save();
        // return response()->json(['success'=>'data saved successfully'] , 201);
        // }

    }


}
