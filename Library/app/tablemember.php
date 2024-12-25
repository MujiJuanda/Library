<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Member</title>
  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- jQuery UI JS -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- jsGrid -->
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid-theme.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
 <!-- Include Navbar -->
 <?php include 'navbar/navbar.php'; ?>

 <!-- Include Sidebar -->
 <?php include 'sidebar/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Member</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Member</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Dialog Form Pop-up -->
    <div id="dialog" title="Tambah Data member" style="display:none;">
      <form id="memberForm">
        <div class="form-group">
          <label for="id_member">ID Member</label>
          <input type="text" class="form-control" id="id_member" name="id_member" required>
        </div>
        <div class="form-group">
          <label for="nama">Nama Member</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
      </form>
    </div>
    

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel member</h3>
          <button id="btnTambahData" class="btn btn-success float-right">Tambah Data</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="jsGrid1"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jsGrid -->
<script src="plugins/jsgrid/demos/db.js"></script>
<script src="plugins/jsgrid/jsgrid.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Page specific script -->
<script>
$(function () {
  // // Fungsi untuk memuat data nim
  // function loadnimOptions() {
  //   $.ajax({
  //     url: 'fetch_data/fetch_member.php',
  //     type: 'GET',
  //     dataType: 'json',
  //     success: function (data) {
  //       const nimSelect = $('#nim');
  //       nimSelect.empty(); // Kosongkan dropdown terlebih dahulu
  //       nimSelect.append('<option value="">-- Pilih nim --</option>'); // Tambahkan opsi default
  //       data.forEach(function (item) {
  //         nimSelect.append(`<option value="${item.nim_id}">${item.nim_id} - ${item.nim_nama}</option>`);
  //       });
  //     },
  //     error: function (xhr, status, error) {
  //       console.error("Error fetching nim data:", status, error);
  //     }
  //   });
  // }

  // Panggil fungsi loadnimOptions saat halaman dimuat
  // loadnimOptions();
  
  // Open Dialog and Load nim Data
  $("#btnTambahData").on("click", function () {
    $("#dialog").dialog("option", "title", "Tambah Data member");
    $("#memberForm")[0].reset(); // Reset form for new data entry
    $("#id_member").val(""); // Clear ID field for new entry
    // loadnimOptions(); // Load nim options
    $("#dialog").dialog("open");
  });

  // Tombol Tambah Data
  $("#btnTambahData").on("click", function () {
    $("#dialog").dialog("option", "title", "Tambah Data member"); // Set nama dialog
    $("#memberForm")[0].reset(); // Reset form sebelum input baru
    $("#dialog").dialog("open"); // Buka dialog form
  });

  // Inisialisasi jsGrid dan ambil data
  $.ajax({
    url: 'fetch_data/fetch_member.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      $("#jsGrid1").jsGrid({
        height: "100%",
        width: "100%",
        sorting: true,
        data: data,
        fields: [
          { name: "id_member", type: "number", width: 50, title: "id_member" },
          { name: "nama", type: "text", width: 150, title: "nama" },
          {
            name: "Aksi",
            type: "control",
            width: 100,
            itemTemplate: function(value, item) {
              var updateButton = $("<button>")
                .text("Update")
                .addClass("btn btn-primary btn-sm")
                .on("click", function() {
                  // Pastikan nilai id_member sudah ada di form dan dikirim
                  var id_member = item.id_member; // Pastikan id_member yang benar

                  $("#dialog").dialog("option", "title", "Update Data member"); // Set nama untuk update
                  $("#id_member").val(id_member); // Set id_member di form

                  $("#nama").val(item.nama);

                  $("#action").val("update");  // Pastikan action "update" dikirim

                  $("#dialog").dialog("open"); 

                  // Ketika tombol simpan (di dalam dialog) diklik, lakukan aksi update
                  $("#btnSave").off("click").on("click", function() {
                    // Mengambil data dari form
                    var id_member = $("#id_member").val();
                    var nama = $("#nama").val();

                    // Mengirimkan data update ke server menggunakan AJAX
                    $.ajax({
                      type: "POST",
                      url: "crud/crud_member.php",
                      data: {
                        action: "update",  // Menandakan aksi update
                        id_member: id_member,
                        nama: nama
                      },
                      success: function(response) {
                        alert(response); // Menampilkan pesan setelah update
                        $("#jsGrid1").jsGrid("loadData"); // Memuat ulang data di jsGrid
                        $("#dialog").dialog("close"); // Menutup dialog setelah update
                      },
                      error: function(xhr, status, error) {
                        console.error("Error updating data:", status, error);
                      }
                    });
                  });
                });


              var deleteButton = $("<button>")
                .text("Delete")
                .addClass("btn btn-danger btn-sm ml-2")
                .on("click", function() {
                  if (confirm("Apakah Anda yakin ingin menghapus member ini?")) {
                    $.ajax({
                      type: "POST",
                      url: "crud/crud_member.php",
                      data: { action: 'delete', id_member: item.id_member },
                      success: function(response) {
                        alert(response); // Menampilkan pesan dari response
                        $("#jsGrid1").jsGrid("loadData"); // Muat ulang data di jsGrid
                      },
                      error: function(xhr, status, error) {
                        console.error("Error deleting data:", status, error);
                      }
                    });
                  }
                });

              return $("<div>").append(updateButton).append(deleteButton);
            }
          }
        ]
      });
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data: ", status, error);
    }
  });

  // Inisialisasi jQuery UI Dialog
  $("#dialog").dialog({
    autoOpen: false,
    modal: true,
    width: 400,
    buttons: {
      "Simpan": function() {
        var formData = {
          action: 'create', // Set to 'create' untuk tambah data
          id_member: $("#id_member").val(),
          nama: $("#nama").val()
        };

        $.ajax({
          type: "POST",
          url: "crud/crud_member.php",
          data: formData,
          success: function(response) {
            alert(response); // Menampilkan pesan sukses/error
            $("#jsGrid1").jsGrid("loadData"); // Muat ulang data di jsGrid
            $("#dialog").dialog("close"); // Tutup dialog
          },
          error: function(xhr, status, error) {
            console.error("Error saving data:", status, error);
          }
        });
      },
      "Batal": function() {
        $(this).dialog("close");
      }
    }
  });
});
</script>




</body>
</html>
