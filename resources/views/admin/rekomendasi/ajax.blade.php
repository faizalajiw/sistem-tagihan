<script> 
$(function () {
  
  var table = $("#dataTable2").DataTable({
      processing: true,
      serverSide: true,
      "responsive": false,
      ajax: "{{ route('rekomendasi.index') }}",
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

// Reset Form
function resetForm(){
    $("[name='nama_dokter_rekomendasi']").val("")
    $("[name='alamat_rekomendasi']").val("")
    $("[name='ttl']").val("")
    $("[name='no_str']").val("")
    $("[name='alamat_praktik_dimiliki']").val("")
    $("[name='alamat_praktik_diminta']").val("")
    $("[name='idi_cabang']").val("")
    $("[name='no_rekomendasi']").val("")
}

// create
$("#store").on("submit", function(e) {
  e.preventDefault()
  $.ajax({
    url: "{{ route('rekomendasi.store') }}",
    method: "POST",
    data: $(this).serialize(),
    success:function(response) {
      if ($.isEmptyObject(response.error)) {
        $("#createModal").modal("hide")
        $('#dataTable2').DataTable().ajax.reload()
        Swal.fire(
          '',
          response.message,
          'success'
        )
        resetForm()
      }else{
        printErrorMsg(response.error)
      }
    }
  });
})

// create-error-validation
function printErrorMsg(msg) {
  $(".print-error-msg").find("ul").html('');
  $(".print-error-msg").css('display', 'block');
  $.each(msg, function(key, value) {
    $(".print-error-msg").find("ul").append('<li>'+value+'</li>')
  });
}

// edit
$("body").on("click", ".btn-edit", function() {
  var id = $(this).attr("id")
  $.ajax({
    url: "/admin/rekomendasi/"+id+"/edit",
    method: "GET",
    success: function(response) {
      $("#id_edit").val(response.data.id)
      $("#nama_dokter_rekomendasi_edit").val(response.data.nama_dokter_rekomendasi)
      $("#alamat_rekomendasi_edit").val(response.data.alamat_rekomendasi)
      $("#ttl_edit").val(response.data.ttl)
      $("#no_str_edit").val(response.data.no_str)
      $("#alamat_praktik_dimiliki_edit").val(response.data.alamat_praktik_dimiliki)
      $("#alamat_praktik_diminta_edit").val(response.data.alamat_praktik_diminta)
      $("#idi_cabang_edit").val(response.data.idi_cabang)
      $("#no_rekomendasi_edit").val(response.data.no_rekomendasi)
      $("#editModal").modal("show")
    },
    error: function(err) {
      if (err.status == 403) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Not allowed!'
        })
      }
    }
  })
})

// update
$("#update").on("submit", function(e) {
  e.preventDefault()
  var id = $("#id_edit").val()
  $.ajax({
    url: "/admin/rekomendasi/"+id,
    method: "PATCH",
    data: $(this).serialize(),
    success: function(response) {
      if ($.isEmptyObject(response.error)) {
        $("#editModal").modal("hide")
        $('#dataTable2').DataTable().ajax.reload()
        Swal.fire(
          '',
          response.message,
          'success'
        )
      }else{
        printErrorMsg(response.error)
      }
    },
    error: function(err) {
      if (err.status == 403) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Not allowed!'
        })
      }
    }
  })
})

// delete
$("body").on("click", ".btn-delete", function() {
  var id = $(this).attr("id")

  Swal.fire({
    title: 'Yakin hapus data ini?',
    // text: "You won't be able to revert",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/admin/rekomendasi/"+id,
        method: "DELETE",
        success: function(response) {
          $('#dataTable2').DataTable().ajax.reload()
          Swal.fire(
            '',
            response.message,
            'success'
          )
        },
        error: function(err) {
          if (err.status == 403) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Not allowed!'
            })
          }
        }
      })
    }
  })
})

//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
})  
</script>