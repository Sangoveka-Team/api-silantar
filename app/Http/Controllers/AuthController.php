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
    public function RegisterUser(Request $request){
        $credentials = $request->validate( [
            'users' => 'required|string',
            'email' => 'required|email:dns|min:3|max:255|unique:users|confirmed',
            'password' => 'required|min:5|max:255',
            'nomor' => 'required',
        ]);

        $user = New User();
            $user->email = $request->email;
            $user->name = $request->nama;
            $user->password = bcrypt($request->password);
            $user->nomor = '62' . $request->nomor;
            $user->birth = 'Silahkan isi tanggal lahir anda';
            $user->image = 'user.svg';
            $user->havebengkel = false;

            if($user->save()){
                SendEmailVerificationNotification();
                $token = $user->createToken('token')->plainTextToken;
                return ApiFormatter::createApi(200, 'register berhasil', $token);
            } else{
                return ApiFormatter::createApi(401, 'register gagal');
            }

            event(new Registered($user));

            Auth::login($user);
        
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
                return ApiFormatter::createApi(200, 'Authenticated User', $token);
                
            } else {
                return ApiFormatter::createApi(401, 'Login Failed');
                
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'Login Failed', $error);
        }
    }


    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return ApiFormatter::createApi(200, "logout success");
    }

}
