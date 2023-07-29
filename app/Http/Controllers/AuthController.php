<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helper\ApiFormatter;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

class AuthController extends Controller
{
    public function registerUser(Request $request){
        $request->validate( [
            'nama' => 'required|string',
            'email' => 'required|email:dns|min:3|max:255|unique:users',
            'password' => 'required|min:5|max:255',
            'nomor' => 'required',
        ]);

        try {
            $user = New User();
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->nomor = '62' . $request->nomor;
            // $user->image = null;
            // $user->email_verified_at = null;
            // $user->jabatan = null;
            $user->poin = 0;
            $user->daerah = '-';

            if($user->save()){
                event(new Registered($user));
                // Auth::login($user);
                $user->sendEmailVerificationNotification();
                // $token = $user->createToken('token')->plainTextToken;
                return ApiFormatter::createApi(200, 'register berhasil', $user);
            } else{
                return ApiFormatter::createApi(401, 'register gagal');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'register gagal', $error); 
        }

        
    }

    public function login(Request $request){
        try {
            $credentials = $request->validate( [
                'email' => 'required|email:dns',
                'password' => 'required|min:5',
            ]);
    
            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->email)->first();
                $token = $user->createToken('token')->plainTextToken;

                $data = [
                    "token" => $token,
                    "userLevel" => $user->level,
                    "userEmailVerified" => $user->email_verified_at,
                ];

                return ApiFormatter::createApi(200, 'Authenticated User', $data);
                
            } else {
                return ApiFormatter::createApi(401, 'Login Failed');
                
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(422, 'invalid', $error);
        }
    }


    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return ApiFormatter::createApi(200, "logout success");
    }

}
