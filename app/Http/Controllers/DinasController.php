<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ApiFormatter;
use App\Helper\uniqueGenerateIdLapor;
use App\Models\Laporan;
use Exception;
use App\Models\Images;
use App\Models\Kategori;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allLaporan = Laporan::where('dinas_ajuan', auth()->user()->jabatan)->get();
            $allLaporanBelumDiproses = Laporan::where('dinas_ajuan', auth()->user()->jabatan)->where('status_lapor', "Belum Diproses")->get();
            $allLaporanDiproses = Laporan::where('dinas_ajuan', auth()->user()->jabatan)->where('status_lapor', "Diproses")->orWhere('status_lapor', "Pending Dinas")->get();
            $allLaporanDitolak = Laporan::where('dinas_ajuan', auth()->user()->jabatan)->where('status_lapor', "Ditolak")->get();
            $allLaporanTuntas = Laporan::where('dinas_ajuan', auth()->user()->jabatan)->where('status_lapor', "Tuntas")->get();

            $laporanCount = $allLaporan->count();
            $laporanBelumDiprosesCount = $allLaporanBelumDiproses->count();
            $laporaniprosesCount = $allLaporanDiproses->count();
            $laporanDitolakCount = $allLaporanDitolak->count();
            $laporanTuntasCount = $allLaporanTuntas->count();

            $namaUser = auth()->user()->nama;


            $data = [
                "allLaporan" => $laporanCount,
                "laporanBelumDiproses" => $laporanBelumDiprosesCount,
                "laporanDiproses" => $laporaniprosesCount,
                "laporanDitolak" => $laporanDitolakCount,
                "laporanTuntas" => $laporanTuntasCount,
                "namaAdminDinas" => $namaUser,
                "laporanDinas" => $allLaporan,
            ];

            return ApiFormatter::createApi(200, 'success', $data);

            
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'error', $error);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function profile()
    {
        try {
            $user = User::find(auth()->user()->jabatan);

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
            $user = User::findOrFail(auth()->user()->jabatan);

            $user->nama = $request->nama;
            $user->nomor = $request->nomor;
            // $user->email = $request->email;
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

    /**
     * Display the specified resource.
     */
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
}
