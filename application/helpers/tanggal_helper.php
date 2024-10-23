<?php
if (!function_exists('format_tanggal_indonesia_short')) {
    function format_tanggal_indonesia_short($date)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $tanggal = date('j', strtotime($date));
        $bulan_index = date('n', strtotime($date));
        $tahun = date('Y', strtotime($date));

        return $tanggal . ' ' . $bulan[$bulan_index] . ' ' . $tahun;
    }
}
