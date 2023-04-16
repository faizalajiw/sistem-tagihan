<!DOCTYPE html>
<html>
<head>
    <title>GENERATE PDF</title>
</head>
<body>
<br><br>
<center>
  <h2 style="font-family: sans-serif;">Surat Rekomendasi</h2>
</center>
<br>
<div style="float: left;">
  <b style="font-family: sans-serif;">Nama Dokter : {{ $rekomendasi->nama_dokter_rekomendasi }}</h3><br>
</div>

<br><br><br><br><br>
<table border="1" cellspacing="0" cellpadding="10" width="100%">
  <thead>
    <tr>
      <th scope="col" style="font-family: sans-serif;">Nama Dokter</th>
      <th scope="col" style="font-family: sans-serif;">Alamat</th>
      <th scope="col" style="font-family: sans-serif;">Tempat Tanggal Lahir</th>
      <th scope="col" style="font-family: sans-serif;">No STR</th>
      <th scope="col" style="font-family: sans-serif;">Alamat Praktik Yang Dimiliki</th>
      <th scope="col" style="font-family: sans-serif;">Alamat Praktik Yang Diminta</th>
      <th scope="col" style="font-family: sans-serif;">IDI Cabang</th>
      <th scope="col" style="font-family: sans-serif;">No Rekomendasi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="font-family: sans-serif;">{{ $rekomendasi->nama_dokter_rekomendasi }}</td>
      <td style="font-family: sans-serif;">{{ $rekomendasi->alamat_rekomendasi }}</td>
      <td style="font-family: sans-serif;">{{ $rekomendasi->ttl }}</td>
      <td style="font-family: sans-serif;">{{ $rekomendasi->no_str }}</td>
      <td style="font-family: sans-serif;">{{ $rekomendasi->alamat_praktik_dimiliki }}</td>
      <td style="font-family: sans-serif;">{{ $rekomendasi->alamat_praktik_diminta }}</td>
      <td style="font-family: sans-serif;">{{ $rekomendasi->idi_cabang }}</td>
      <td style="font-family: sans-serif;">{{ $rekomendasi->no_rekomendasi }}</td>
    </tr>
  </tbody>
</table>
</body>
</html>