<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helper\ApiFormatter;

class AuthController extends Controller
{
    function RegisterUser(Request $request){
        $credentials = $request->validate( [
            'users' => 'required|string',
            'email' => 'required|email:dns|min:3|max:255|unique:users|confirmed',
            'password' => 'required|min:5|max:255',
        ]);

        $user = New User();
            $user->email = $request->email;
            $user->name = $request->nama;
            $user->password = bcrypt($request->password);
            $user->phonenumber = '62' . $request->phone;
            $user->birth = 'Silahkan isi tanggal lahir anda';
            $user->image = 'user.svg';
            $user->havebengkel = false;

            if($user->save()){
                $token = $user->createToken('token')->plainTextToken;
                return ApiFormatter::createApi(200, 'register berhasil', $token);
            } else{
                return ApiFormatter::createApi(401, 'register gagal');
            }


        
    }
}
