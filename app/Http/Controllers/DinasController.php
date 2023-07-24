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
            $allLaporan = Laporan::where('dinas_ajuan', auth()->user()->id)->get();
            $allLaporanBelumDiproses = Laporan::where('dinas_ajuan', auth()->user()->id)->where('status_lapor', 1)->get();
            $allLaporanDiproses = Laporan::where('dinas_ajuan', auth()->user()->id)->where('status_lapor', 2)->get();
            $allLaporanDitolak = Laporan::where('dinas_ajuan', auth()->user()->id)->where('status_lapor', 3)->get();
            $allLaporanTuntas = Laporan::where('dinas_ajuan', auth()->user()->id)->where('status_lapor', 4)->get();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
