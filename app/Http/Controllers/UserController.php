<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

// kreait firebase
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "token" => "required|string",
        ]);

        $auth = app("firebase.auth");

        try {
            $verifiedIdToken = $auth->verifyIdToken($request->token);
        } catch (FailedToVerifyToken $e) {
            return response()->json([
                'message' => 'The token is invalid: ' . $e->getMessage(),
            ], 401);
        }

        $uid = $verifiedIdToken->claims()->get('sub');
        $firebase_user = $auth->getUser($uid);
        $email = $firebase_user->email;
        $user = User::where('email', $email)->first();

        if (!empty($user)) {
            if ($user->name != null) {
                // $user->update([
                //     'device_id' => $request->device_id,
                // ]);
                $token = $user->createToken("user-google-login")->plainTextToken;

                return response([
                    "message" => "User Authenticated Successfully",
                    "token" => $token,
                    "type" => "old",
                    "status" => true
                ], 200);
            }

        } else {
            $user = new User();
            $user->email = $email;
            $user->device_id = $request->device_id;
            $user->type = "user";
            $user->save();

            $token = $user->createToken("user-google-login")->plainTextToken;

            return response([
                "message" => "User Authenticated",
                "status" => true,
                "type" => "new",
                "token" => $token
            ], 200);
        }
    }

    public function logOut()
    {
        auth("sanctum")->users()->id->tokens()->delete();

        return response([
            "message" => "User Logged Out Successfully",
            "status" => true
        ], 200);
    }
}







