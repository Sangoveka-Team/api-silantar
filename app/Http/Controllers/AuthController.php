<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use \Illuminate\Support\Facades\URL;
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

    public function forgotPassword(Request $request){
        try {
            $user = User::where('email', $request->email)->get();

            if (count($user) > 0) {
                $token = Str::random(50);
                $domain = URL::to('/');
                $url = $domain . '/reset-password?token=' . $token;

                $data = [
                    'url' => $url,
                    'email' => $request->email,
                    'title' => 'Password Reset',
                    'body' => 'Please click on below link to reset your password',
                ];

                Mail::send('forgotPasswordMail', ['data' => $data], function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']);
                });

                $dateTime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $dateTime,
                    ]
                );

                return ApiFormatter::createApi(200, 'Please Check Your Email to Reset your Password');

            } else {
                return ApiFormatter::createApi(404, 'User not found');
            }
            
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'Failed', $error);

        }
    }

    public function resetPasswordLoad(Request $request){
        $resetData = PasswordReset::where('email', $request->email)->get();
        if (isset($request->token) && count($resetData) > 0) {
            $user = User::where('email', $resetData[0]['email'])->get();

            return view('resetPassword', compact('user'));

        } else {
            abort(404);
        }
        
    }

    public function resetPasword(Request $request){
        $request->validate()
    }

}
