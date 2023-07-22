<?php

namespace App\Http\Controllers;

use App\Helper\ApiFormatter;
use App\Helper\uniqueGenerateIdLapor;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Exception;
use App\Models\Images;
use App\Models\Kategori;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

            $laporanImages = Images::where('laporan_id', $laporanTerakhir->id)->first();

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
        $status = Status::all();
        $kategori = Kategori::all();
        $daerah = User::where('level', 'kelurahan')->pluck('daerah_kelurahan')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()) {
            try {
                // $request->validate( [
                //     'alamat' => 'required',
                //     'tanggal' => 'required',
                //     'kategori_lapor' => 'required',
                //     'daerah_kelurahan' => 'required',
                //     'deskripsi' => 'required',
                //     'maps' => 'required',
                //     'image' => 'required',
                // ]);

                // $laporan = new Laporan;

                // $laporan->id_laporan = uniqueGenerateIdLapor::generateUniqueRandomString(10, Laporan::class, 'id_laporan');
                // $laporan->user_id = auth()->user()->id;
                // $laporan->nama = auth()->user()->nama;
                // $laporan->nomor = auth()->user()->nomor;
                // $laporan->alamat = $request->alamat;
                // $laporan->tanggal = Carbon::now()->format('Y-m-d H:i:s');
                // $laporan->kategori_lapor = $request->kategori_lapor;
                // $laporan->status_lapor = 1;
                // $laporan->daerah_kelurahan = $request->daerah_kelurahan;
                // $laporan->dinas_ajuan = null;
                // $laporan->deskripsi = $request->deskripsi;
                // $laporan->maps = $request->maps;
                // $laporan->catatan_kelurahan = null;
                // $laporan->catatan_laporan_kelurahan = null;
                // $laporan->catatan_laporan_dinas = null;

                // $images = new Images;

                // $image = $request->file('image');
                // $imageName = time() . '.' . $image->extension();
                // $image->move(public_path('img'), $imageName);
                // $path =  "public/img/" . $imageName;

                // $images->laporan_id = $laporan->id;
                // $images->image_name = $path;

                dd('ini ketika user login membuat laporan');

                // if ($laporan->create()) {
                //     $data = [
                //         "laporan" => $laporan,
                //         "images" => $images,
                //     ];

                //     return ApiFormatter::createApi(200, 'success', $data);
                // } else {
                //     return ApiFormatter::createApi(401, 'failed');
                // }
                

            } catch (\Throwable $error) {
                // return ApiFormatter::createApi(401, 'failed', $error);
            }

        } else {
            try {
                // $request->validate( [
                //     'alamat' => 'required',
                //     'tanggal' => 'required',
                //     'kategori_lapor' => 'required',
                //     'daerah_kelurahan' => 'required',
                //     'deskripsi' => 'required',
                //     'maps' => 'required',
                //     // 'image' => 'required',
                // ]);

                $laporan = new Laporan;

                $str = uniqueGenerateIdLapor::generateUniqueRandomString(10, Laporan::class, 'id_laporan');

                $carbonDate = Carbon::now();

                // Mengeluarkan tanggal, bulan, dan tahun
                $day = $carbonDate->day;
                $month = $carbonDate->month;
                $year = $carbonDate->year;

                $laporan->id_laporan = "SILT" . Carbon::now()->format('d') . Carbon::now()->format('m') . Carbon::now()->format('Y') . $str;
                dd($laporan->id_laporan);
                $laporan->user_id = null;
                $laporan->nama = $request->nama;
                $laporan->nomor = $request->nomor;
                $laporan->alamat = $request->alamat;
                $laporan->tanggal = Carbon::now()->format('Y-m-d H:i:s');
                $laporan->kategori_lapor = $request->kategori_lapor;
                $laporan->status_lapor = 1;
                $laporan->daerah_kelurahan = $request->daerah_kelurahan;
                $laporan->dinas_ajuan = null;
                $laporan->deskripsi = $request->deskripsi;
                $laporan->maps = $request->maps;
                $laporan->catatan_kelurahan = null;
                $laporan->catatan_laporan_kelurahan = null;
                $laporan->catatan_laporan_dinas = null;

                $images = new Images;

                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('img'), $imageName);
                $path =  "public/img/" . $imageName;

                $images->laporan_id = $laporan->id;
                $images->image_name = $path;

                // dd($request);

                // dd('ini ketika user guest membuat laporan', $laporan);

                if ($laporan->create() && $images->create()) {
                    $data = [
                        "laporan" => $laporan,
                        "images" => $images,
                    ];

                    return ApiFormatter::createApi(200, 'success', $data);
                } else {
                    return ApiFormatter::createApi(401, 'failed');
                }
                

            } catch (\Throwable $error) {
                return ApiFormatter::createApi(401, 'failed', $error);
            }
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
