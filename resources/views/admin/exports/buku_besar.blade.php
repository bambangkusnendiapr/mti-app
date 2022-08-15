<table>
    <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <th colspan="4" style="text-align: center;">PT. MARCOS TRANS INDONESIA</th>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <th colspan="4" style="text-align: center;">BUKU BESAR</th>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="2" style="text-align: center;">Periode</td>
        <td style="text-align: center;">{{ $dari }}</td>
        <td style="text-align: center;">{{ $ke }}</td>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    @foreach($kodeAkun as $ka)
      <tr>
          <th>&nbsp;</th>
          <th style="text-align: center;"><b>{{ $ka->kode_akun }}</b></th>
          <th style="text-align: center;"><b>{{ $ka->nama_akun }}</b></th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
      </tr>
      <tr>
          <th>&nbsp;</th>
          <th style="text-align: center;"><b>Tanggal</b></th>
          <th style="text-align: center;"><b>Uraian</b></th>
          <th><b>Debet</b></th>
          <th><b>Kredit</b></th>
      </tr>
      <tr>
          <th>&nbsp;</th>
          <th colspan="2" style="text-align: center;"><b>SALDO AWAL</b></th>
          @if($ka->normal == "DEBET")
            <th><b>{{ $ka->saldo_awal }}</b></th>
            <th><b>0</b></th>
          @else
            <th><b>0</b></th>
            <th><b>{{ $ka->saldo_awal }}</b></th>
          @endif
      </tr>
      @foreach($transaksi->where('kode_akun', $ka->id) as $t)
        <tr>
            <th>&nbsp;</th>
            <th>{{ $t->posting->tanggal }}</th>
            <th>{{ $t->posting->uraian }}</th>
            <th>{{ $t->debet }}</th>
            <th>{{ $t->kredit }}</th>
        </tr>
      @endforeach
      <tr>
        <th>&nbsp;</th>
        <th colspan="2" style="text-align: center;"><b>JUMLAH</b></th>
        <th><b>{{ $transaksi->where('kode_akun', $ka->id)->sum('debet') }}</b></th>
        <th><b>{{ $transaksi->where('kode_akun', $ka->id)->sum('kredit') }}</b></th>
      </tr>
      <tr>
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
      </tr>
    @endforeach
</table>