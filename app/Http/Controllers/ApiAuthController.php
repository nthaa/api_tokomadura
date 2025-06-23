<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    //login
    public function login(LoginRequest $request){
        //validate dgn Auth::attempt
        if(Auth::attempt($request->only('email','password'))){
            // jika berhasil buat token
            $user = User::where('email', $request->email)->first();
            // token lama di hapus
            $user->tokens()->delete();
            // token baru di create
            $token = $user->createToken('token')->plainTextToken;
            return new LoginResource([
                  'token' =>$token,
                  'user' => $user
              ]);
        }else{
            // jika gagal kirim response error
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        // // check if user exists
        // $user = User::where('email', $request->email)->first();
        // // check if password is correct
        // if(!$user || !Hash::check($request->password, $user->password)){
        //     return response()->json([
        //         'message' => 'Bad credentials'
        //     ], 401);
        // }
        // // generate token
        // $token = $user->createToken('token')->plainTextToken;
        // // return $user->createToken('token')->plainTextToken;

        // return new LoginResource([
        //   // 'message' =>'Success',
        //     'token' =>$token,
        //     'user' => $user
        // ]);
    }

    // register
    public function register(RegisterRequest $request){

        // save user to user table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        $token = $user->createToken('token')->plainTextToken;

        // return token
        return new LoginResource([
            'token' => $token,
            'user' => $user
        ]);
    }

    // logout
    public function logout(Request $request){
        // hapus token by user nya
        if ($request->user()) {
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logged out succesfully',
        ]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
   }
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'message' => 'Password lama salah.',
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah.',
        ]);
    }

}
