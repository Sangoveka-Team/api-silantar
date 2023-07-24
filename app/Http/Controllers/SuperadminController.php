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
            $allLaporanBelumDiproses = User::where('daerah_kelurahan', auth()->user()->id)->where('status_lapor', 1)->get();
            $allLaporanDiproses = User::where('daerah_kelurahan', auth()->user()->id)->where('status_lapor', 2)->get();
            $allLaporanDitolak = User::where('daerah_kelurahan', auth()->user()->id)->where('status_lapor', 3)->get();
            $allLaporanTuntas = User::where('daerah_kelurahan', auth()->user()->id)->where('status_lapor', 4)->get();

            $userCount = $allUser->count();
            $laporanBelumDiprosesCount = $allLaporanBelumDiproses->count();
            $laporaniprosesCount = $allLaporanDiproses->count();
            $laporanDitolakCount = $allLaporanDitolak->count();

            $namaUser = auth()->user()->nama;


            $data = [
                "jumlahUser" => $userCount,
                "jumlahAkunDinas" => $laporanBelumDiprosesCount,
                "jumlahAkunKelurahan" => $laporaniprosesCount,
                "jumlahAkunPelapor" => $laporanDitolakCount,
                "namaSuperadmin" => $namaUser,
                "allUser" => $allUser,
            ];

            return ApiFormatter::createApi(200, 'success', $data);


        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }

    public function createUser(){
        $userLevel = User::pluck('level');

        // foreach (StatusEnum::getValues() as $value) {
        //     // echo $value . PHP_EOL;
        // }
    }


    public function storeUser(Request $request){
        try {
            $user = new User;

            $user->nama = $request->nama;
            $user->nomor = $request->nomor;
            $user->email = $request->email;
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
}
