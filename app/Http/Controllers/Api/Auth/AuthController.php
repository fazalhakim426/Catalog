<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;  
use JWTAuth; 
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException; 
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{

     
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated
        //Creat token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
 	
 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
   
}
