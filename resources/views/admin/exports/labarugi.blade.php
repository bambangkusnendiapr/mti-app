<table>
    <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <th colspan="5" style="text-align: center;">PT. MARCOS TRANS INDONESIA</th>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <th colspan="5" style="text-align: center;">LAPORAN LABA RUGI</th>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="5" style="text-align: center;">Per 31 Desember 2021</td>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <th style="text-align: center;">Kode Akun</th>
        <th style="text-align: center;">Nama Akun</th>
        <th style="text-align: center;">Debet</th>
        <th style="text-align: center;">Kredit</th>
        <th style="text-align: center;">Balance</th>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th><b>PENDAPATAN</b></th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    @foreach($transaksiPendapatan as $tp)
      <tr>
          <th>&nbsp;</th>
          <th>{{ $tp->akun->kode_akun }}</th>
          <th>{{ $tp->akun->nama_akun }}</th>
          <th>{{ $transaksi->where('kode_akun', $tp->akun->id)->sum('debet') }}</th>
          <th>{{ $transaksi->where('kode_akun', $tp->akun->id)->sum('kredit') }}</th>
          <th>&nbsp;</th>
      </tr>
    @endforeach
    <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>Total Pendapatan</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>{{ $totalPendapatan }}</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>Laba/Rugi Kotor</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>{{ $totalPendapatan }}</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>BEBAN OPERASIONAL</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    @foreach($transaksiBebanOperasional as $tbo)
      <tr>
          <th>&nbsp;</th>
          <th>{{ $tbo->akun->kode_akun }}</th>
          <th>{{ $tbo->akun->nama_akun }}</th>
          <th>{{ $transaksi->where('kode_akun', $tbo->akun->id)->sum('debet') }}</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
      </tr>
    @endforeach
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>Total Pengeluaran Operasional</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>{{ $totalBebanOperasional }}</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>Total Pendapatan Kotor</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>{{ $totalPendapatanKotor }}</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>PENDAPATAN LAIN-LAIN</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    @foreach($transaksiPendapatanLain as $tpl)
      <tr>
          <th>&nbsp;</th>
          <th>{{ $tpl->akun->kode_akun }}</th>
          <th>{{ $tpl->akun->nama_akun }}</th>
          <th>&nbsp;</th>
          <th>{{ $transaksi->where('kode_akun', $tpl->akun->id)->sum('kredit') }}</th>
          <th>&nbsp;</th>
      </tr>
    @endforeach
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>Total Pendapatan Lain-lain</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>{{ $totalPendapatanLain }}</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>BEBAN ADMINISTRASI DAN KANTOR</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    @foreach($transaksiAdministrasi as $ta)
      <tr>
          <th>&nbsp;</th>
          <th>{{ $ta->akun->kode_akun }}</th>
          <th>{{ $ta->akun->nama_akun }}</th>
          <th>{{ $transaksi->where('kode_akun', $ta->akun->id)->sum('debet') }}</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
      </tr>
    @endforeach
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>Total Pengeluaran Beban Administrasi dan Kantor</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>{{ $totalAdministrasi }}</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>PENYUSUTAN DAN AMORTISASI</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    @foreach($transaksiPenyusutan as $tnyusut)
      <tr>
          <th>&nbsp;</th>
          <th>{{ $tnyusut->akun->kode_akun }}</th>
          <th>{{ $tnyusut->akun->nama_akun }}</th>
          <th>{{ $transaksi->where('kode_akun', $tnyusut->akun->id)->sum('debet') }}</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
      </tr>
    @endforeach
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>Total Penyusutan dan Amortisasi</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>{{ $totalPenyusutan }}</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>BEBAN BUNGA, PAJAK DAN LAINNYA</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    @foreach($transaksiBebanBunga as $tbb)
      <tr>
          <th>&nbsp;</th>
          <th>{{ $tbb->akun->kode_akun }}</th>
          <th>{{ $tbb->akun->nama_akun }}</th>
          <th>{{ $transaksi->where('kode_akun', $tbb->akun->id)->sum('debet') }}</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
      </tr>
    @endforeach
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>Total Beban Bunga, Pajak dan Lainnya</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>{{ $totalBebanBunga }}</th>
    </tr>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><b>Laba/Rugi Bersih</b></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>{{ $labaRugiBersih }}</th>
    </tr>
</table>