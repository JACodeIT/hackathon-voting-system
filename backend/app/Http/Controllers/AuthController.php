<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController Instance
     *
     *  @return void
     */

     public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
     }

     /**
      * Get a JWT via given credentials.
      *
      * @return \Illuminate\Http\JsonResponse
      */

     public function login(Request $request){
         $validator = Validator::make($request->all(), [
             'email' => 'required|email',
             'password' => 'required|string|min:8'
         ]);

         if($validator->fails()){
             return response()->json($validator->errors(), 422);
         }

         if(!$token = auth()->attempt($validator->validated())){
             return response()->json(['error'=> 'Unauthorized'], 401);
         }

         return $this->createNewToken($token);
     }

     /**
      * Register a User
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function register(Request $request){
         $validator = Validator::make($request->all(),[
             'username'             => 'required|string|between:2,50|unique:users',
             'email'                => 'required|string|email|max:100|unique:users',
             'password'             => 'required|string|confirmed|min:8',
             'roles'                => 'required|string',
         ]);

         if($validator->fails()){
             return response()->json($validator->errors()->toJson(), 400);
         }

         $user = User::create(array_merge(
             $validator->validated(),
             ['password' => bcrypt($request->password)]
         ));

         return response()->json([
             'message' => 'User successfully registered',
             'user' => $user
         ], 201);
     }

     /**
      * Log the user out (Invalidate Token)
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function logout(){
         auth()->logout();
         return response()->json(['message' => 'User successfully signed out.']);
     }

     /**
      * Refresh a token.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function refresh(){
         return $this->createNewToken(auth()->refresh());
     }

     /**
      * Get the Authenticated User.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function userProfile(){
         return response()->json(auth()->user());
     }

     /**
      * Get the token array structure
      *
      * @param string $token
      *
      * @return \Illuminate\Http\JsonResponse
      */
     protected function createNewToken($token){
         return response()->json([
             'access_token'  => $token,
             'token_type'    => 'bearer',
             'expires_in'    => auth()->factory()->getTTL() * 60,
             'user'          => auth()->user(),
         ]);
     }
}
