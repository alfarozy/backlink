<?php

use Carbon\Carbon;

function currencyIDR($value)
{
    return 'Rp ' . number_format($value, 0, ',', '.');
}

function IDRToNum($value)
{
    return preg_replace('/\D/', '', $value);
}

function random_code()
{

    return rand(1111, 9999);
}


function publicImage($image)
{
    return '/storage/' . $image;
}

function defaultImage($image)
{
    return $image && ($image != '-') ? publicImage($image) : '/assets/img/no-image.jpg';
}

function getPercent($price, $percent, $decimals = 2)
{
    if ($price == 0) {
        return 0;
    }

    return ($percent / 100) * $price;
}

function isExpired($expire_date)
{
    $now = new DateTime();


    // Cek format tanggal kedaluwarsa
    $is_full_format = strpos($expire_date, ':') !== false;

    // Ubah format tanggal kedaluwarsa sesuai dengan kondisi
    $expiration_date = $is_full_format
        ? DateTime::createFromFormat('Y-m-d H:i:s', $expire_date)->format('Y-m-d')
        : DateTime::createFromFormat('Y-m-d', $expire_date);

    // Ubah format tanggal saat ini hanya menjadi 'Y-m-d'
    $current_date = $now->format('Y-m-d');

    // Bandingkan tanggal kedaluwarsa dan tanggal saat ini
    if ($current_date > $expiration_date) {
        // The expiration date has passed
        return true;
    } else {
        // The expiration date has not passed yet
        return false;
    }
}
function mobaFormatTime($datetime, $format = 'm/d/Y h:i A')
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format($format);
}

function arrayToString($array)
{
    // Mengubah array menjadi string dipisahkan dengan koma
    $string = implode(', ', $array);

    // Mengganti koma terakhir dengan kata "dan"
    $string = preg_replace('/,([^,]*)$/', ' dan$1', $string);

    // Tampilkan hasil konversi
    echo $string;
}

function generateTransactionID()
{
    // Mendapatkan tanggal saat ini
    $date = date('Ymd');

    // Mendapatkan angka acak antara 1000 dan 9999
    $randomNumber = rand(1000, 9999);

    // Menggabungkan prefix "FF", tanggal, dan angka acak
    $transactionID = 'FF' . $date . $randomNumber;

    return $transactionID;
}
