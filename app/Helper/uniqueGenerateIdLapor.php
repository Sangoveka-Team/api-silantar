<?php

Namespace App\Helper;
use Illuminate\Support\Str;

Class uniqueGenerateIdLapor
{
    public static function generateUniqueRandomString($length, $model, $field)
    {
        $randomString = Str::random($length);

        while ($model->where($field, $randomString)->exists()) {
            $randomString = Str::random($length);
        }

        return $randomString;
    }
}
?>