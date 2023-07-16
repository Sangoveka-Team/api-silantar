<?php

namespace App\Http\Controllers;

use App\Helper\ApiFormatter;
use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use App\Models\Images;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = User::all();

        // return ApiFormatter::createApi(200, "ini adalah halaman lapor", $user);

        try {
            $allLaporanBelumDiproses = Laporan::where('user_id', auth()->user()->id)->where('status_lapor', 1)->get();
            $allLaporanDiproses = Laporan::where('user_id', auth()->user()->id)->where('status_lapor', 2)->get();
            $allLaporanDitolak = Laporan::where('user_id', auth()->user()->id)->where('status_lapor', 3)->get();
            $allLaporanTuntas = Laporan::where('user_id', auth()->user()->id)->where('status_lapor', 4)->get();

            $laporanBelumDiprosesCount = $allLaporanBelumDiproses->count();
            $laporaniprosesCount = $allLaporanDiproses->count();
            $laporanDitolakCount = $allLaporanDitolak->count();
            $laporanTuntasCount = $allLaporanTuntas->count();

            $laporanTerakhir = Laporan::where('user_id', auth()->user()->id)->latest()->first();

            $laporanImages = Images::where('laporan_id', $laporanTerakhir->id)->latest()->first();

            $poinUser = auth()->user()->poin;

            $data = [
                "laporanBelumDiproses" => $laporanBelumDiprosesCount,
                "laporanDiproses" => $laporaniprosesCount,
                "laporanDitolak" => $laporanDitolakCount,
                "laporanTuntas" => $laporanTuntasCount,
                "poinUser" => $poinUser,
                "laporanTerakhir" => $laporanTerakhir,
                "laporanImages" => $laporanImages,
            ];

            return ApiFormatter::createApi(200, 'success', $data);

            
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'error', $error);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
