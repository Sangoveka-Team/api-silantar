<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Status;

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
            "nomor" => "081932432211",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Sungai Jingah",
            "email" => "lurahsujing@gmail.com",
            "password" => bcrypt("sujing123"),
            "poin" => null,
            "jabatan" => "operator kelurahan sungai jingah",
            "nomor" => "081932432212",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Sungai Andai",
            "email" => "lurahsundai@gmail.com",
            "password" => bcrypt("sundai123"),
            "poin" => null,
            "jabatan" => "operator kelurahan sungai andai",
            "nomor" => "081932432213",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Angsau",
            "email" => "lurahangsau@gmail.com",
            "password" => bcrypt("angsau123"),
            "poin" => null,
            "jabatan" => "operator kelurahan angsau",
            "nomor" => "081932432214",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Antasan Besar",
            "email" => "lurahantasanbesar@gmail.com",
            "password" => bcrypt("antasanbesar123"),
            "poin" => null,
            "jabatan" => "operator kelurahan antasan besar",
            "nomor" => "081932432215",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Kelurahan Antasan Kecil",
            "email" => "lurahantasankecil@gmail.com",
            "password" => bcrypt("antasankecil123"),
            "poin" => null,
            "jabatan" => "operator kelurahan antasan kecil",
            "nomor" => "081932432216",
            "level" => "kelurahan",
        ]);
        User::create([
            "nama" => "Dinas Lingkungan Hidup",
            "email" => "dinasLH@gmail.com",
            "password" => bcrypt("lh123"),
            "poin" => null,
            "jabatan" => "operator dinas lingkungan hidup",
            "nomor" => "085821791552",
            "level" => "dinas",
        ]);
        User::create([
            "nama" => "Dinas Pekerjaan Umum dan Perumahan Rakyat",
            "email" => "dinasPUPR@gmail.com",
            "password" => bcrypt("pupr123"),
            "poin" => null,
            "jabatan" => "operator dinas pupr",
            "nomor" => "085821791553",
            "level" => "dinas",
        ]);
        User::create([
            "nama" => "Dinas Perhubungan",
            "email" => "dinasperhubungan@gmail.com",
            "password" => bcrypt("perhubungan123"),
            "poin" => null,
            "jabatan" => "operator dishub",
            "nomor" => "085821791554",
            "level" => "dinas",
        ]);
        User::create([
            "nama" => "Dinas Kominfo",
            "email" => "dinaskominfo@gmail.com",
            "password" => bcrypt("kominfo123"),
            "poin" => null,
            "jabatan" => "operator diskominfo",
            "nomor" => "085821791555",
            "level" => "dinas",
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
        
    }
}
        
// Berikut adalah daftar semua kelurahan di Kota Banjarmasin:

// 1. Kelurahan Alalak
// 2. Kelurahan Angsau
// 3. Kelurahan Antasan Besar
// 4. Kelurahan Antasan Kecil
// 5. Kelurahan Astambul
// 6. Kelurahan Banjar Sari
// 7. Kelurahan Basirih
// 8. Kelurahan Belitung Utara
// 9. Kelurahan Gadang
// 10. Kelurahan Gandhil
// 11. Kelurahan Handil Bakti
// 12. Kelurahan Harapan Baru
// 13. Kelurahan Kelayan Dalam
// 14. Kelurahan Kelayan Luar
// 15. Kelurahan Kuin Cerucuk
// 16. Kelurahan Kuin Utara
// 17. Kelurahan Kuripan
// 18. Kelurahan Landasan Ulin Barat
// 19. Kelurahan Landasan Ulin Timur
// 20. Kelurahan Loktabat Selatan
// 21. Kelurahan Loktabat Utara
// 22. Kelurahan Mentaos
// 23. Kelurahan Pemurus Baru
// 24. Kelurahan Pemurus Dalam
// 25. Kelurahan Sungai Andai
// 26. Kelurahan Sungai Jingah
// 27. Kelurahan Telaga Biru
// 28. Kelurahan Teluk Dalam
// 29. Kelurahan Tumpang Sari
// 30. Kelurahan Sungai Baru
// 31. Kelurahan Sungai Bilu
// 32. Kelurahan Sungai Miai
// 33. Kelurahan Sungai Tiung
// 34. Kelurahan Sungai Ulin
// 35. Kelurahan Tambelan Barat
// 36. Kelurahan Tambelan Timur
// 37. Kelurahan Tungkaran
// 38. Kelurahan Tungkaran Batu