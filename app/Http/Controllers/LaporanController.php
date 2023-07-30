<?php

namespace App\Http\Controllers;

use App\Helper\ApiFormatter;
use App\Helper\uniqueGenerateIdLapor;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Exception;
use App\Models\Notes;
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
            $allLaporanBelumDiproses = Laporan::where('user_id', auth()->user()->id)->where('status_lapor', "Belum Diproses")->get();
            $allLaporanDiproses = Laporan::where('user_id', auth()->user()->id)->where('status_lapor', "Diproses")->get();
            $allLaporanDitolak = Laporan::where('user_id', auth()->user()->id)->where('status_lapor', "Ditolak")->get();
            $allLaporanTuntas = Laporan::where('user_id', auth()->user()->id)->where('status_lapor', "Tuntas")->get();

            $laporanBelumDiprosesCount = $allLaporanBelumDiproses->count();
            $laporaniprosesCount = $allLaporanDiproses->count();
            $laporanDitolakCount = $allLaporanDitolak->count();
            $laporanTuntasCount = $allLaporanTuntas->count();

            $laporanTerakhir = Laporan::where('user_id', auth()->user()->id)->latest()->first();

            $poinUser = auth()->user()->poin;

            $data = [
                "laporanBelumDiproses" => $laporanBelumDiprosesCount,
                "laporanDiproses" => $laporaniprosesCount,
                "laporanDitolak" => $laporanDitolakCount,
                "laporanTuntas" => $laporanTuntasCount,
                "poinUser" => $poinUser,
                "laporanTerakhir" => $laporanTerakhir === null ? null : $laporanTerakhir,
                "namaUser" => auth()->user()->nama,
                "fotoUser" => auth()->user()->image,
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
        try {
            $kategori = Kategori::select('kategori_laporan')->get();
            $daerah = User::where('level', 'Kelurahan')->select('daerah')->get();

            $data = [
                "kategoriLapor" => $kategori,
                "daerah Laporan" => $daerah,
            ];
            
            return ApiFormatter::createApi(200, 'success', $data);

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
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
                // ]);

                $laporan = new Laporan;

                $str = uniqueGenerateIdLapor::generateUniqueRandomString(10, Laporan::class, 'id_laporan');

                $carbonDate = Carbon::now();

                // Mengeluarkan tanggal, bulan, dan tahun
                $day = $carbonDate->day;
                $month = $carbonDate->month;
                $year = $carbonDate->year;

                $laporan->id_laporan = "SILT" . $day . $month . $year . $str;
                $laporan->user_id = auth()->user()->id;
                $laporan->user_image = auth()->user()->image;
                $laporan->nama = auth()->user()->nama;
                $laporan->nomor = auth()->user()->nomor;
                $laporan->alamat = $request->alamat;
                $laporan->tanggal = Carbon::now()->format('Y-m-d H:i:s');
                $laporan->kategori_lapor = $request->kategori_lapor;
                $laporan->status_lapor = "Belum Diproses";
                $laporan->daerah_kelurahan = $request->daerah_kelurahan;
                $laporan->dinas_ajuan = null;
                $laporan->deskripsi = $request->deskripsi;
                $laporan->maps = $request->maps;
                $laporan->konfirmasi_dinas = 'false';

                $laporan->save();

                if ($request->hasFile('image')) {
                    $images = $request->file('image');   

                    foreach ($images as $image) {
                        $imageName = time() . '.' . $image->extension();
                        $image->move(public_path('img'), $imageName);
                        $path = 'img/' . $imageName;
                        $fileImage = new Images;
                        $fileImage->laporan_id = $laporan->id;
                        $fileImage->image_name = $path;

                        // dd($fileImage);
                        $fileImage->save();

                    }
                }

                $imgLaporan = Images::where('laporan_id', $laporan->id)->get();


                if ($imgLaporan !== null) {
                    $data = [
                        "laporan" => $laporan,
                        "images" => $imgLaporan,
                    ];

                return ApiFormatter::createApi(200, 'success', $data);
                } else {
                    return ApiFormatter::createApi(401, 'failed');
                }
                

            } catch (\Throwable $error) {
                return ApiFormatter::createApi(401, 'failed', $error);
            }

        } else {
            try {
                // $request->validate([
                //     'alamat' => 'required',
                //     'tanggal' => 'required',
                //     'kategori_lapor' => 'required',
                //     'daerah_kelurahan' => 'required',
                //     'deskripsi' => 'required',
                //     'maps' => 'required',
                // ]);

                $laporan = new Laporan;

                $str = uniqueGenerateIdLapor::generateUniqueRandomString(10, Laporan::class, 'id_laporan');

                $carbonDate = Carbon::now();

                // Mengeluarkan tanggal, bulan, dan tahun
                $day = $carbonDate->day;
                $month = $carbonDate->month;
                $year = $carbonDate->year;

                $laporan->id_laporan = "SILT" . $day . $month . $year . $str;
                $laporan->user_id = null;
                $laporan->user_image = null;
                $laporan->nama = $request->nama;
                $laporan->nomor = '62' . $request->nomor;
                $laporan->alamat = $request->alamat;
                $laporan->tanggal = Carbon::now()->format('Y-m-d H:i:s');
                $laporan->kategori_lapor = $request->kategori_lapor;
                $laporan->status_lapor = "Belum Diproses";
                $laporan->daerah_kelurahan = $request->daerah_kelurahan;
                $laporan->dinas_ajuan = null;
                $laporan->deskripsi = $request->deskripsi;
                $laporan->maps = $request->maps;
                $laporan->konfirmasi_dinas = 'false';

                $laporan->save();

                if ($request->hasFile('image')) {
                    $images = $request->file('image');   

                    foreach ($images as $image) {
                        $imageName = time() . '.' . $image->extension();
                        $image->move(public_path('img'), $imageName);
                        $path = 'img/' . $imageName;
                        $fileImage = new Images;
                        $fileImage->laporan_id = $laporan->id;
                        $fileImage->image_name = $path;

                        // dd($fileImage);
                        $fileImage->save();

                    }
                }

                $imgLaporan = Images::where('laporan_id', $laporan->id)->get();
                // dd($imgLaporan);

                // dd('ini ketika user guest membuat laporan', $laporan);

                if ($imgLaporan !== null) {
                    $data = [
                        "laporan" => $laporan,
                        "images" => $imgLaporan,
                    ];

                    return ApiFormatter::createApi(200, 'success', $data);
                } else {
                    return ApiFormatter::createApi(401, 'failed');
                }
                

            } catch (\Throwable $error) {
                // return ApiFormatter::createApi(401, 'failed', $error);
            }
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

            $notes = Notes::where('laporan_id', $id)->get();

            $data = [
                "dataLaporan" => $laporan,
                "gambarLaporan" => $images,
                "catatan" => $notes,
            ];

            return ApiFormatter::createApi(200, 'success', $data);
        } catch (Exception $error) {
            return ApiFormatter::createApi(200, 'success', $error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function riwayat()
    {
        try {
            $today = Carbon::today();
            $yesterday = Carbon::yesterday();
            $oneWeekAgo = Carbon::now()->subWeek();
            $oneMonthAgo = Carbon::now()->subMonth();

            // dd($yesterday);

            $laporanHariIni = Laporan::where('user_id', auth()->user()->id)->where('tanggal', '>=', $today)->get();
            $laporanKemarin = Laporan::where('user_id', auth()->user()->id)->where('tanggal', '>=', $yesterday)->where('tanggal', '<', $today)->orderBy('tanggal', 'desc')->get();
            $laporanMingguIni = Laporan::where('user_id', auth()->user()->id)->where('tanggal', '>=', $oneWeekAgo)->where('tanggal', '<', $yesterday)->orderBy('tanggal', 'desc')->get();
            $laporanBulanIni = Laporan::where('user_id', auth()->user()->id)->where('tanggal', '>=', $oneMonthAgo)->where('tanggal', '<', $oneWeekAgo)->orderBy('tanggal', 'desc')->get();
            $laporanLebihLama = Laporan::where('user_id', auth()->user()->id)->where('tanggal', '<', $oneMonthAgo)->get();

            $data = [
                'laporanHariIni' => $laporanHariIni,
                'laporanKemarin' => $laporanKemarin,
                'laporanMingguIni' => $laporanMingguIni,
                'laporanBulanIni' => $laporanBulanIni,
                'laporanLebihLama' => $laporanLebihLama,
            ];

            return ApiFormatter::createApi(200, 'success get data', $data);

        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'success get data', $error);
        }

        
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

    public function allLaporan(){
        try {
            $laporan = Laporan::all();
            
            return ApiFormatter::createApi(200, 'success get data', $laporan);
        } catch (Exception $error) {
            return ApiFormatter::createApi(401, 'failed', $error);
        }
    }
}
