@extends('layouts.backend.app')
@section('title', 'Data Dokter')
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
@section('content_title', 'Data Dokter')
@section('content')
<x-alert></x-alert>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
      @can('create-dokter')
      	<a href="javascript:void(0)" class="btn btn-primary btn-sm" 
        data-toggle="modal" data-target="#createModal">
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
            <th>NPA</th>
            <th>Alamat</th>
            <th>No Whatsapp</th>
            <th>Praktek 1</th>
            <th>Praktek 2</th>
            <th>Praktek 3</th>
            <th>Status</th>
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
                <label for="nama_dokter">Nama Dokter :</label>
                <input required="" type="text" name="nama_dokter" id="nama_dokter" class="form-control" autocomplete="off">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="username">Email :</label>
                <input required="" type="email" name="username" id="username" class="form-control" autocomplete="off">  
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="npa">NPA :</label>
                <input type="text" name="npa" id="npa" class="form-control" autocomplete="off">  
              </div>
            </div>
            <div class="col-lg-3 ">
              <div class="form-group">
                <label for="alamat">Alamat :</label>
                <textarea type="text" name="alamat" id="alamat" class="form-control input-lg" autocomplete="off" ></textarea>
                <!-- <input type="text" name="alamat" id="alamat" class="form-control input-lg" autocomplete="off"> -->
              </div>
            </div>
          </div>
          <!-- AKHIR BARIS KE 1 -->

          <!-- BARIS KE 2 -->
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="no_telepon">No Whatsapp :</label>
                <input required="" type="tel" name="no_telepon" id="no_telepon" class="form-control" autocomplete="off">
              </div>
            </div>  
            <div class="col-lg-3">
              <div class="form-group">
                <label for="praktek_1">Praktek 1 :</label>
                <input type="text" name="praktek1" id="praktek1" class="form-control">
              </div>
            </div>  
            <div class="col-lg-3">
              <div class="form-group">
                <label for="praktek_2">Praktek 2 :</label>
                <input type="text" name="praktek2" id="praktek2" class="form-control">
              </div>
            </div>  
            <div class="col-lg-3">
              <div class="form-group">
                <label for="praktek_3">Praktek 3 :</label>
                <input type="text" name="praktek3" id="praktek3" class="form-control">
              </div>
            </div>  
            <div class="col-lg-3">
              <div class="form-group">
                <label for="status">Status :</label>
                <select id="status" name="status" class="form-control">
                  <option value="IDI Brebes">IDI Brebes</option>
                  <option value="IDI Luar">IDI Luar</option>
                </select>
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
        <h5 class="modal-title" id="createModalLabel">Edit Data</h5>
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
            <div class="col-lg-3">
              <div class="form-group">
                <label for="nama_dokter_edit">Nama Dokter :</label>
                <input type="hidden" name="id_edit" id="id_edit" class="form-control" readonly="">
                <input required="" type="text" name="nama_dokter" id="nama_dokter_edit" class="form-control">
              </div>
            </div>  
            <div class="col-lg-3">
              <div class="form-group">
                <label for="npa">NPA :</label>
                <input type="text" name="npa" id="npa_edit" class="form-control">  
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="alamat">Alamat :</label>
                <input type="text" name="alamat" id="alamat_edit" class="form-control" rows="3">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="no_telepon">No Whatsapp :</label>
                <input required="" type="text" name="no_telepon" id="no_telepon_edit" class="form-control">
              </div>
            </div>  
          </div>
          <!-- AKHIR BARIS KE 1 -->

          <!-- BARIS KE 2 -->
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="praktek_1">Praktek 1 :</label>
                <input type="text" name="praktek1" id="praktek1_edit" class="form-control">
              </div>
            </div>  
            <div class="col-lg-3">
              <div class="form-group">
                <label for="praktek-2">Praktek 2 :</label>
                <input type="text" name="praktek2" id="praktek2_edit" class="form-control">
              </div>
            </div>  
            <div class="col-lg-3">
              <div class="form-group">
                <label for="praktek_3">Praktek 3 :</label>
                <input type="text" name="praktek3" id="praktek3_edit" class="form-control">
              </div>
            </div>  
            <div class="col-lg-3">
              <div class="form-group">
                <label for="status">Status :</label>
                <select id="status" name="status" class="form-control">
                  <option value="IDI Brebes">IDI Brebes</option>
                  <option value="IDI Luar">IDI Luar</option>
                </select>
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
@include('admin.dokter.ajax')
@endpush