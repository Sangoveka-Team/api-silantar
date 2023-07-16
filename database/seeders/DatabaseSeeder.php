<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Images;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Status;
use App\Models\Laporan;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "nama" => "Kelurahan Alalak",
            "email" => "lurahalalak@gmail.com",
            "password" => bcrypt("alalak123"),
            "poin" => null,
            "jabatan" => "operaotr kelurahan alalak",
            "nomor" => "6281932432211",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Sungai Jingah",
            "email" => "lurahsujing@gmail.com",
            "password" => bcrypt("sujing123"),
            "poin" => null,
            "jabatan" => "operator kelurahan sungai jingah",
            "nomor" => "6281932432212",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Sungai Andai",
            "email" => "lurahsundai@gmail.com",
            "password" => bcrypt("sundai123"),
            "poin" => null,
            "jabatan" => "operator kelurahan sungai andai",
            "nomor" => "6281932432213",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Angsau",
            "email" => "lurahangsau@gmail.com",
            "password" => bcrypt("angsau123"),
            "poin" => null,
            "jabatan" => "operator kelurahan angsau",
            "nomor" => "6281932432214",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Antasan Besar",
            "email" => "lurahantasanbesar@gmail.com",
            "password" => bcrypt("antasanbesar123"),
            "poin" => null,
            "jabatan" => "operator kelurahan antasan besar",
            "nomor" => "6281932432215",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Antasan Kecil",
            "email" => "lurahantasankecil@gmail.com",
            "password" => bcrypt("antasankecil123"),
            "poin" => null,
            "jabatan" => "operator kelurahan antasan kecil",
            "nomor" => "6281932432216",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Dinas Lingkungan Hidup",
            "email" => "dinasLH@gmail.com",
            "password" => bcrypt("lh123"),
            "poin" => null,
            "jabatan" => "operator dinas lingkungan hidup",
            "nomor" => "6285821791552",
            "level" => "dinas",
        ]);
        User::create([
            "nama" => "Dinas Pekerjaan Umum dan Perumahan Rakyat",
            "email" => "dinasPUPR@gmail.com",
            "password" => bcrypt("pupr123"),
            "poin" => null,
            "jabatan" => "operator dinas pupr",
            "nomor" => "6285821791553",
            "level" => "dinas",
        ]);
        User::create([
            "nama" => "Dinas Perhubungan",
            "email" => "dinasperhubungan@gmail.com",
            "password" => bcrypt("perhubungan123"),
            "poin" => null,
            "jabatan" => "operator dishub",
            "nomor" => "6285821791554",
            "level" => "dinas",
        ]);
        User::create([
            "nama" => "Dinas Kominfo",
            "email" => "dinaskominfo@gmail.com",
            "password" => bcrypt("kominfo123"),
            "poin" => null,
            "jabatan" => "operator diskominfo",
            "nomor" => "6285821791555",
            "level" => "dinas",
        ]);
        User::create([
            "nama" => "ricko",
            "email" => "rickosog@gmail.com",
            "password" => bcrypt("silantar123"),
            "poin" => null,
            "jabatan" => null,
            "nomor" => "6281932432218",
            "level" => "pelapor",
        ]);


        Kategori::create([
            "kategori_laporan" => "Pencemaran Lingkungan",
        ]);
        Kategori::create([
            "kategori_laporan" => "Bencana",
        ]);
        Kategori::create([
            "kategori_laporan" => "Fasilitas Umum",
        ]);
        Kategori::create([
            "kategori_laporan" => "Arus Lalu Lintas",
        ]);
        Kategori::create([
            "kategori_laporan" => "Lainnya",
        ]);


        Status::create([
            "status_laporan" => "Belum Diproses",
        ]);
        Status::create([
            "status_laporan" => "Diproses",
        ]);
        Status::create([
            "status_laporan" => "Ditolak",
        ]);
        Status::create([
            "status_laporan" => "Tuntas",
        ]);

        Laporan::create([
            "IDLaporan" => "SILT000001",
            "user_id" => 11,
            "nama" => "ricko",
            "nomor" => "6281932432218",
            "alamat" => "Jalan padat Karya Komplek Purnama Permai 3",
            "tanggal" => Carbon::now()->format('Y-m-d H:i:s'),
            "maps" => "0997hrh, 8397932779239742",
            "kategori_lapor" => 1,
            "status_lapor" => 1,
            "daerahkelurahan" => 3,
            "deskripsi" => "di jalan padat karya terdapat sebuah TPS yang tidak semestinya (di dalam lingungan warga)",
        ]);

        Images::create([
            "laporan_id" => "1",
            "image_name" => "gambar1.jpg",
        ]);
        Images::create([
            "laporan_id" => "1",
            "image_name" => "gambar2.jpg",
        ]);
        
    }
}