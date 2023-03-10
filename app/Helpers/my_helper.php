<?php
function format_indo($date)
{
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $waktu = substr($date, 11, 5);
    $hari = date("w", strtotime($date));
    $result = $Hari[$hari] . ", " . $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

    return $result;
}
function format_bulan($date)
{
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    // pemisahan bulan
    $bulan = substr($date, 5, 2);
    $result = $Bulan[(int)$bulan - 1];

    return $result;
}
function format_tahun($date)
{
    date_default_timezone_set('Asia/Jakarta');
    // pemisahan tahun
    $tahun = substr($date, 0, 4);
    $result = $tahun;
    return $result;
}
function format_tanggal($date)
{
    date_default_timezone_set('Asia/Jakarta');
    // pemisahan tanggal yang mempunyai waktu
    $tgl = substr($date, 0, 10);
    $result = $tgl;
    return $result;
}
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
function format_tgl_surat($date)
{
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    // pemisahan tahun, bulan, hari, dan waktu
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date, 8, 2);
    $waktu = substr($date, 11, 5);
    $hari = date("w", strtotime($date));
    $result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun;

    return $result;
}
