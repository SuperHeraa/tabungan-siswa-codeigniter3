<?php
date_default_timezone_set("Asia/Jakarta");


function tgl_id($date)
{
    $Bulan = array(
        "Jan", "Feb", "Mar", "Apr",
        "Mei", "Jun", "Jul", "Agu", "Sep",
        "Okt", "Nov", "Des"
    );
    $Hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $waktu = substr($date, 11, 5);
    $hari = date("w", strtotime($date));
    return $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;
}
