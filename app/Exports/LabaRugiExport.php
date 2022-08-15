<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Model\Akuntansi\KodeAkun;
use App\Model\Akuntansi\Transaksi;

class LabaRugiExport implements FromView
{
    public function view(): View
    {
        $sessionTanggal = session()->get('sessionTanggal');
        $dari = $sessionTanggal['dari'];
        $ke   = $sessionTanggal['ke'];
        $transaksi  = Transaksi::whereBetween('tanggal',[$dari,$ke])->get();

        $kodeAkunPendapatan = KodeAkun::whereIn('kode_akun', ['4010', '4030', '5100'])->get('id');
        $transaksiPendapatan = Transaksi::select('kode_akun')->groupBy('kode_akun')->whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunPendapatan)->get();
        $totalPendapatan = Transaksi::whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunPendapatan)->sum('debet') + Transaksi::whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunPendapatan)->sum('kredit');

        $kodeAkunBebanOperasional = KodeAkun::whereIn('kode_akun', [
            '6110', 
            '6120',
            '6130',
            '6140',
            '6150',
            '6160',
            '6170',
            '6180',
            '6190',
            '6200',
            '6210',
            '6220',
            '6230',
            '6240',
            '6250',
            '6270',
            '6281',
            '6350',
            '6360',
            '6370',
            '6380',
            '6390',
            '6400',
            '6410',
            '6600',
            '6700'
        ])->get('id');
        $transaksiBebanOperasional = Transaksi::select('kode_akun')->groupBy('kode_akun')->whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunBebanOperasional)->get();
        $totalBebanOperasional = Transaksi::whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunBebanOperasional)->sum('debet');

        $kodeAkunPendapatanLain = KodeAkun::whereIn('kode_akun', ['4020', '4510'])->get('id');
        $transaksiPendapatanLain = Transaksi::select('kode_akun')->groupBy('kode_akun')->whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunPendapatanLain)->get();
        $totalPendapatanLain = Transaksi::whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunPendapatanLain)->sum('kredit');

        $kodeAkunAdministrasi = KodeAkun::whereIn('kode_akun', [
            '6260',
            '6280',
            '6290',
            '6330',
            '6331',
            '6332',
            '6333',
            '6340',
            '6900',
            '6901',
            '6282'
        ])->get('id');
        $transaksiAdministrasi = Transaksi::select('kode_akun')->groupBy('kode_akun')->whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunAdministrasi)->get();
        $totalAdministrasi = Transaksi::whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunAdministrasi)->sum('debet');

        $kodeAkunPenyusutan = KodeAkun::whereIn('kode_akun', [
            '6300',
            '6310',
            '6320',
            '6500'
        ])->get('id');
        $transaksiPenyusutan = Transaksi::select('kode_akun')->groupBy('kode_akun')->whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunPenyusutan)->get();
        $totalPenyusutan = Transaksi::whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunPenyusutan)->sum('debet');

        $kodeAkunBebanBunga = KodeAkun::whereIn('kode_akun', [
            '7010',
            '7020',
            '7030',
            '7040',
            '7050'
        ])->get('id');
        $transaksiBebanBunga = Transaksi::select('kode_akun')->groupBy('kode_akun')->whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunBebanBunga)->get();
        $totalBebanBunga = Transaksi::whereBetween('tanggal',[$dari,$ke])->whereIn('kode_akun', $kodeAkunBebanBunga)->sum('debet');

        return view('admin.exports.labarugi', [
            'dari' => $dari,
            'ke' => $ke,
            'transaksi' => $transaksi,
            'transaksiPendapatan' => $transaksiPendapatan,
            'totalPendapatan' => $totalPendapatan,
            'transaksiBebanOperasional' => $transaksiBebanOperasional,
            'totalBebanOperasional' => $totalBebanOperasional,
            'totalPendapatanKotor' => $totalPendapatan - $totalBebanOperasional,
            'transaksiPendapatanLain' => $transaksiPendapatanLain,
            'totalPendapatanLain' => $totalPendapatanLain,
            'transaksiAdministrasi' => $transaksiAdministrasi,
            'totalAdministrasi' => $totalAdministrasi,
            'transaksiPenyusutan' => $transaksiPenyusutan,
            'totalPenyusutan' => $totalPenyusutan,
            'transaksiBebanBunga' => $transaksiBebanBunga,
            'totalBebanBunga' => $totalBebanBunga,
            'labaRugiBersih' => ($totalPendapatan - $totalBebanOperasional) + $totalPendapatanLain - $totalAdministrasi - $totalPenyusutan - $totalBebanBunga
        ]);
    }
}