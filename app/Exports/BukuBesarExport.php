<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Model\Akuntansi\KodeAkun;
use App\Model\Akuntansi\Transaksi;

class BukuBesarExport implements FromView
{
    public function view(): View
    {
        $sessionTanggal = session()->get('sessionTanggal');
        $dari = $sessionTanggal['dari'];
        $ke   = $sessionTanggal['ke'];

        return view('admin.exports.buku_besar', [
            'dari' => $dari,
            'ke' => $ke,
            'kodeAkun' => KodeAkun::orderBy('kode_akun', 'ASC')->get(),
            'transaksi' => Transaksi::whereBetween('tanggal',[$dari,$ke])->get()
        ]);
    }
}