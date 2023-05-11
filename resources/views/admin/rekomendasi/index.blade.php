@extends('layouts.backend.app')
@section('title', 'Rekomendasi')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Sweetalert 2 -->
<link rel="stylesheet" type="text/css" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content_title', 'Data Rekomendasi')
@section('content')
<x-alert></x-alert>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        @can('create-rekomendasi')
        <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
          <i class="fas fa-plus fa-fw"></i> Tambah Data
        </a>
        @endcan
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive table-sm">
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
              <th>Aksi</th>
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

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="store">
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display: none;">
            <ul></ul>
          </div>
          <!-- BARIS KE 1 -->
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="nama_dokter_rekomendasi">Nama Dokter :</label>
                <input type="text" name="nama_dokter_rekomendasi" id="nama_dokter_rekomendasi" class="form-control" autocomplete="off">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="alamat_rekomendasi">Alamat :</label>
                <textarea type="text" name="alamat_rekomendasi" id="alamat_rekomendasi" class="form-control" autocomplete="off"></textarea>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="ttl">Tempat Tanggal Lahir :</label>
                <input type="text" name="ttl" id="ttl" class="form-control" autocomplete="off">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="no_str">No STR :</label>
                <input type="text" name="no_str" id="no_str" class="form-control" autocomplete="off">
              </div>
            </div>
          </div>
          <!-- AKHIR BARIS KE 1 -->

          <!-- BARIS KE 2 -->
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="alamat_praktik_dimiliki">Alamat Praktik Yang Dimiliki :</label>
                <textarea type="text" name="alamat_praktik_dimiliki" id="alamat_praktik_dimiliki" class="form-control" autocomplete="off"></textarea>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="alamat_praktik_diminta">Alamat Praktik Yang Diminta :</label>
                <textarea type="text" name="alamat_praktik_diminta" id="alamat_praktik_diminta" class="form-control" autocomplete="off"></textarea>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="idi_cabang">IDI Cabang :</label>
                <input type="text" name="idi_cabang" id="idi_cabang" class="form-control" autocomplete="off">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="no_rekomendasi">No Rekomendasi :</label>
                <input type="text" name="no_rekomendasi" id="no_rekomendasi" class="form-control" autocomplete="off">
              </div>
            </div>
          </div>
          <!-- AKHIR BARIS KE 2 -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save fa-fw"></i> SIMPAN
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Create Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Edit Data Rekomendasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="update">
        <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display: none;">
            <ul></ul>
          </div>
          <!-- BARIS KE 1 -->
          <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <label for="nama_dokter_rekomendasi_edit">Nama Dokter:</label>
                <input type="hidden" name="id_edit" id="id_edit" class="form-control" >
                <input type="text" name="nama_dokter_rekomendasi" id="nama_dokter_rekomendasi_edit" class="form-control">
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label for="alamat_rekomendasi">Alamat:</label>
                <textarea type="text" name="alamat_rekomendasi" id="alamat_rekomendasi_edit" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label for="ttl">Tempat Tanggal Lahir</label>
                <input type="text" name="ttl" id="ttl_edit" class="form-control" >
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label for="no_str">No STR:</label>
                <input type="text" name="no_str" id="no_str_edit" class="form-control">
              </div>
            </div>
          </div>
          <!-- AKHIR BARIS KE 1 -->

          <!-- BARIS KE 2 -->
          <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <label for="no_str">Alamat Praktik Yang Dimiliki</label>
                <textarea type="text" name="alamat_praktik_dimiliki" id="alamat_praktik_dimiliki_edit" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label for="no_str">Alamat Praktik Yang Diminta</label>
                <textarea type="text" name="alamat_praktik_diminta" id="alamat_praktik_diminta_edit" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label for="idi_cabang">IDI Cabang</label>
                <input type="text" name="idi_cabang" id="idi_cabang_edit" class="form-control">
              </div>
            </div>
            <div class="col-lg-5">
              <div class="form-group">
                <label for="no_rekomendasi">No Rekomendasi</label>
                <input type="text" name="no_rekomendasi" id="no_rekomendasi_edit" class="form-control">
              </div>
            </div>
          </div>
          <!-- AKHIR BARIS KE 2 -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save fa-fw"></i> UPDATE
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Modal -->

@stop

@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Sweetalert 2 -->
<script type="text/javascript" src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/plugins/select2/js/select2.full.min.js"></script>
@include('admin.rekomendasi.ajax')
@endpush