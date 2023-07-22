<?php

Namespace App\Helper;
use Illuminate\Support\Str;
use App\Models\Laporan;

Class uniqueGenerateIdLapor
{
    public static function generateUniqueRandomString($length, $model, $field)
    {
        $randomString = Str::random($length);

        while (Laporan::where($field, $randomString)->exists()) {
            $randomString = Str::random($length);
        }

        return $randomString;
    }
}
?>