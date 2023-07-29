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
            "poin" => 0,
            "jabatan" => "Kelurahan Alalak",
            "nomor" => "6281932432211",
            "daerah" => "Alalak",
            "image" => "imgProfil1.jpg",
            "level" => "Kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Sungai Jingah",
            "email" => "lurahsujing@gmail.com",
            "password" => bcrypt("sujing123"),
            "poin" => 0,
            "jabatan" => "Kelurahan Sungai Jingah",
            "nomor" => "6281932432212",
            "daerah" => "Sungai Jingah",
            "image" => "imgProfil2.jpg",
            "level" => "Kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Sungai Andai",
            "email" => "lurahsundai@gmail.com",
            "password" => bcrypt("sundai123"),
            "poin" => 0,
            "jabatan" => "Kelurahan Sungai Andai",
            "nomor" => "6281932432213",
            "daerah" => "Sungai Andai",
            "image" => "imgProfil3.jpg",
            "level" => "Kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Angsau",
            "email" => "lurahangsau@gmail.com",
            "password" => bcrypt("angsau123"),
            "poin" => 0,
            "jabatan" => "Kelurahan Angsau",
            "nomor" => "6281932432214",
            "daerah" => "Angsau",
            "image" => "imgProfil4.jpg",
            "level" => "Kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Antasan Besar",
            "email" => "lurahantasanbesar@gmail.com",
            "password" => bcrypt("antasanbesar123"),
            "poin" => 0,
            "jabatan" => "Kelurahan Antasan Besar",
            "nomor" => "6281932432215",
            "daerah" => "Antasan Besar",
            "image" => "imgProfil5.jpg",
            "level" => "Kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Antasan Kecil",
            "email" => "lurahantasankecil@gmail.com",
            "password" => bcrypt("antasankecil123"),
            "poin" => 0,
            "jabatan" => "Kelurahan Antasan Kecil",
            "nomor" => "6281932432216",
            "daerah" => "Antasan Kecil",
            "image" => "imgProfil6.jpg",
            "level" => "Kelurahan",
        ]);
        User::create([
            "nama" => "Dinas Lingkungan Hidup",
            "email" => "dinasLH@gmail.com",
            "password" => bcrypt("lh123"),
            "poin" => 0,
            "jabatan" => "Dinas Lingkungan Hidup",
            "nomor" => "6285821791552",
            "daerah" => "Banjarmasin",
            "image" => "imgProfil7.jpg",
            "level" => "Dinas",
        ]);
        User::create([
            "nama" => "Dinas Pekerjaan Umum dan Perumahan Rakyat",
            "email" => "dinasPUPR@gmail.com",
            "password" => bcrypt("pupr123"),
            "poin" => 0,
            "jabatan" => "Dinas Pekerjaan Umum dan Perumahan Rakyat",
            "nomor" => "6285821791553",
            "daerah" => "Banjarmasin",
            "image" => "imgProfil8jpg",
            "level" => "Dinas",
        ]);
        User::create([
            "nama" => "Dinas Perhubungan",
            "email" => "dinasperhubungan@gmail.com",
            "password" => bcrypt("perhubungan123"),
            "poin" => 0,
            "jabatan" => "Dinas Perhubungan",
            "nomor" => "6285821791554",
            "daerah" => "Banjarmasin",
            "image" => "imgProfil9.jpg",
            "level" => "Dinas",
        ]);
        User::create([
            "nama" => "Dinas Kominfo",
            "email" => "dinaskominfo@gmail.com",
            "password" => bcrypt("kominfo123"),
            "poin" => 0,
            "jabatan" => "Dinas Komunikasi dan Informasi",
            "nomor" => "6285821791555",
            "daerah" => "Banjarmasin",
            "image" => "imgProfil10",
            "level" => "Dinas",
        ]);
        User::create([
            "nama" => "ricko",
            "email" => "rickosog@gmail.com",
            "password" => bcrypt("silantar123"),
            "poin" => 0,
            "jabatan" => null,
            "nomor" => "6281932432218",
            "daerah" => "-",
            "image" => "public/img/ricko.jpg",
            "level" => "Pelapor",
        ]);
        User::create([
            "nama" => "superadmin",
            "email" => "superadmin@gmail.com",
            "password" => bcrypt("superadmin123"),
            "poin" => 0,
            "jabatan" => 'superadmin SILANTAR',
            "nomor" => "6281932224567",
            "daerah" => "-",
            "image" => "public/img/superadmin.jpg",
            "level" => "Superadmin",
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
        Status::create([
            "status_laporan" => "Pending Dinas",
        ]);

        Laporan::create([
            "id_laporan" => "SILT000001",
            "user_id" => 11,
            "user_image" => 'public/img/ricko.jpg',
            "nama" => "ricko",
            "nomor" => "6281932432218",
            "alamat" => "Jalan padat Karya Komplek Purnama Permai 3",
            "tanggal" => Carbon::now()->format('Y-m-d H:i:s'),
            "maps" => "0997hrh, 8397932779239742",
            "kategori_lapor" => 'Pencemaran Lingkungan',
            "status_lapor" => "Belum Diproses",
            "daerah_kelurahan" => "Sungai Andai",
            "dinas_ajuan" => null,
            "deskripsi" => "di jalan padat karya terdapat sebuah TPS yang tidak semestinya (di dalam lingungan warga)",
        ]);

        Laporan::create([
            "id_laporan" => "SILT000002",
            "user_id" => null,
            "user_image" => null,
            "nama" => "syifa",
            "nomor" => "6281932432217",
            "alamat" => "Jalan jalan ke kota banjarmasin",
            "tanggal" => Carbon::now()->format('Y-m-d H:i:s'),
            "maps" => "0997hrh, 8397932779239742",
            "kategori_lapor" => "Bencana",
            "status_lapor" => "Belum Diproses",
            "daerah_kelurahan" => "Antasan Kecil",
            "dinas_ajuan" => null,
            "deskripsi" => "di jalan terdapat banyak kerusakan",
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