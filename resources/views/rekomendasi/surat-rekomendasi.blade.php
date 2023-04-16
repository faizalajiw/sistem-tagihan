@extends('layouts.backend.app')
@section('title', 'Data Rekomendasi')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content_title', 'Cetak Surat Rekomendasi')
@section('content')
<x-alert></x-alert>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">

      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="dataTable2" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Dokter</th>
            <th>Alamat</th>
            <th>Tempat, Tanggal Lahir</th>
            <th>No STR</th>
            <th>Alamat Praktik Yang Dimiliki</th>
            <th>Alamat Praktik Yang Diminta</th>
            <th>IDI Cabang</th>
            <th>No Rekomendasi</th>
            <th>Print</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@stop

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
$(function () {

  var table = $("#dataTable2").DataTable({
      processing: true,
      serverSide: true,
      "responsive": true,
      ajax: "{{ route('rekomendasi.surat-rekomendasi') }}",
      columns: [
          {data: 'DT_RowIndex' , name: 'id'},
          {data: 'nama_dokter_rekomendasi', name: 'nama_dokter_rekomendasi'},
          {data: 'alamat_rekomendasi', name: 'alamat_rekomendasi'},
          {data: 'ttl', name: 'ttl'},
          {data: 'no_str', name: 'no_str'},
          {data: 'alamat_praktik_dimiliki', name: 'alamat_praktik_dimiliki'},
          {data: 'alamat_praktik_diminta', name: 'alamat_praktik_diminta'},
          {data: 'idi_cabang', name: 'idi_cabang'},
          {data: 'no_rekomendasi', name: 'no_rekomendasi'},
          {data: 'action', name: 'action', orderable: false, searchable: true},
      ]
  });

});
</script>
@endpush