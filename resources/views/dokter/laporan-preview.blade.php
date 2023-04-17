<!DOCTYPE html>
<html>
<head>
    <title>GENERATE PDF</title>
</head>
<body>
<br><br>
<center>
  <h2 style="font-family: sans-serif;">Laporan Pembayaran</h2><br><br>
</center>
<div style="float: left;">
  <b style="font-family: sans-serif;">Nama Dokter : {{ $data_dokter->nama_dokter }}</b><br><br>
  <b style="font-family: sans-serif;">NPA : {{ $data_dokter->npa }}</b><br>
</div>
<br><br><br><br>
<b>Untuk Tahun : {{ request()->tahun_bayar }}</b><br><br>
<table border="1" cellspacing="0" cellpadding="10" width="100%">
  <thead>
    <tr>
      <th style="font-family: sans-serif;">No</th>
      <th style="font-family: sans-serif;">Nama Dokter</th>
      <th style="font-family: sans-serif;">NPA</th>
      <th style="font-family: sans-serif;">Tanggal Bayar</th>
      <th style="font-family: sans-serif;">Status</th>
      <th style="font-family: sans-serif;">Untuk Bulan</th>
      <th style="font-family: sans-serif;">Untuk Tahun</th>
      <th style="font-family: sans-serif;">Nominal</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pembayaran as $row)
    <tr>
      <td style="font-family: sans-serif;">{{ $loop->iteration }}</td>
      <td style="font-family: sans-serif;">{{ $row->dokter->nama_dokter }}</td>
      <td style="font-family: sans-serif;">{{ $row->npa }}</td>
      <td style="font-family: sans-serif;">{{ \Carbon\Carbon::parse($row->tanggal_bayar)->format('d-m-Y') }}</td>
      <td style="font-family: sans-serif;">{{ $row->dokter->status }}</td>
      <td style="font-family: sans-serif;">{{ $row->bulan_bayar }}</td>
      <td style="font-family: sans-serif;">{{ $row->tahun_bayar }}</td>
      <td style="font-family: sans-serif;">{{ $row->jumlah_bayar }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>