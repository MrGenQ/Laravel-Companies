<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()
            ->json(['data'=>$user, 'access_token' => $token]);
    }
    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()
            ->json([
                'message' => 'Hello' . " " . $user->name . " " . 'Your token' . ": " . $token,
                'name' => $user->name,
                'id' => $user->id,
                'token'=>$token,
            ]);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()
            ->json(['message' => 'Goodbey, you are logged out']);
    }
}
