<?php

namespace App\Http\Controllers;

use App\Helper\ApiFormatter;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Images;
use Exception;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function index(){
        try {
            $allUser = User::all();
            $userDinas = User::where('level', 'Dinas')->get();
            $userKelurahan = User::where('level', 'Kelurahan')->get();
            $userPelapor = User::where('level', 'Pelapor')->get();

            $userCount = $allUser->count();
            $userDinasCount = $userDinas->count();
            $userKelurahanCount = $userKelurahan->count();
            $userPelaporCount = $userPelapor->count();

            $namaUser = auth()->user()->nama;


            $data = [
                "jumlahUser" => $userCount,
                "jumlahAkunDinas" => $userDinasCount,
                "jumlahAkunKelurahan" => $userKelurahanCount,
                "jumlahAkunPelapor" => $userPelaporCount,
                "namaSuperadmin" => $namaUser,
                "allUser" => $allUser,
            ];

            return ApiFormatter::createApi(200, 'success', $data);


        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }

    // public function createUser(){
    //     try {
    //         $userLevel = ['pelapor', 'kelurahan', 'dinas', 'pelapor'];

    //         if ($userLevel) {
    //             return ApiFormatter::createApi(200, 'success', $userLevel);
    //         } else{
    //             return ApiFormatter::createApi(401, 'failed');
    //         }
            
    //     } catch (Exception $error) {
    //         return ApiFormatter::createApi(401, 'failed', $error);

    //     }
    // }


    public function storeUser(Request $request){
        try {
            $user = new User;

            $user->nama = $request->nama;
            $user->nomor = '62' . $request->nomor;
            $user->email = $request->email;
            $user->level = $request->level;
            $user->daerah = $request->daerah;
            $user->jabatan = $request->jabatan;
            $user->password = bcrypt($request->password);
            $user->image = null;

            // dd($request->nama);

            if ($user->save()) {
                return ApiFormatter::createApi(200, 'success', $user);
            } else{
                return ApiFormatter::createApi(401, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }

    public function profile()
    {
        try {
            $user = User::find(auth()->user()->id);

            return ApiFormatter::createApi(200, 'success', $user);

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateProfile(Request $request)
    {
        try {
            $user = User::findOrFail(auth()->user()->id);

            $user->nama = $request->nama;
            $user->nomor = $request->nomor;
            // $user->email = $request->email;
            // $user->daerah = $request->daerah;
            $user->jabatan = $request->jabatan;
            $user->password = bcrypt($request->password);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $path =  "public/img/" . $imageName;
                
                $user->image = $path;
            } else {
                $user->image = $user->image;
            }

            // dd($request->nama);

            if ($user->update()) {
                return ApiFormatter::createApi(200, 'success', $user);
            } else{
            return ApiFormatter::createApi(401, 'failed');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }

    public function cekUserPelapor(string $id){
        try {
            $laporan = Laporan::findOrFail($id);

            if ($laporan->user_id !== null) {
                $userPelapor = User::findOrFail($laporan->user_id);

            } else {
                $userPelapor = [
                    "nama" => $laporan->nama, 
                    "nomor" => $laporan->nomor,
                ];
            }
            

            $data = [
                "detailUser" => $userPelapor,
            ];

            return ApiFormatter::createApi(200, 'success', $data);
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }

    public function deleteUser(string $id){
        try {
            $user = User::findOrFail($id);

            if ($user->delete()) {
                return ApiFormatter::createApi(200, 'success');
            } else {
                return ApiFormatter::createApi(401, 'failed');
            }
            
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }

    public function show(string $id)
    {
        try {
            $laporan = Laporan::findOrFail($id);

            $images = Images::where('laporan_id', $id)->get();

            $data = [
                "dataLaporan" => $laporan,
                "gambarLaporan" => $images,
            ];

            return ApiFormatter::createApi(200, 'success', $data);
        } catch (Exception $error) {
            return ApiFormatter::createApi(200, 'success', $error);
        }
    }
}
