<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Pengarang</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- jsGrid -->
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid-theme.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
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
            <h1>Pengarang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengarang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Dialog Form Pop-up -->
    <div id="dialog" title="Tambah Data Pengarang" style="display:none;">
      <form id="pengarangForm">
        <div class="form-group">
          <label for="pengarang_id">ID Pengarang</label>
          <input type="text" class="form-control" id="pengarang_id" name="pengarang_id" required>
        </div>
        <div class="form-group">
          <label for="pengarang_nama">Nama Pengarang</label>
          <input type="text" class="form-control" id="pengarang_nama" name="pengarang_nama" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" name="email" required>
        </div>
      </form>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel pengarang</h3>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jsGrid -->
<script src="plugins/jsgrid/demos/db.js"></script>
<script src="plugins/jsgrid/jsgrid.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
  // Fungsi untuk memuat data pengarang
  function x() {
    $.ajax({
      url: 'fetch_data/fetch_pengarang.php',
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        const pengarangSelect = $('#pengarang');
        pengarangSelect.empty(); // Kosongkan dropdown terlebih dahulu
        pengarangSelect.append('<option value="">-- Pilih Pengarang --</option>'); // Tambahkan opsi default
        data.forEach(function (item) {
          pengarangSelect.append(`<option value="${item.pengarang_id}">${item.pengarang_id} - ${item.pengarang_nama}</option>`);
        });
      },
      error: function (xhr, status, error) {
        console.error("Error fetching pengarang data:", status, error);
      }
    });
  }

  // Open Dialog and Load pengarang Data
  $("#btnTambahData").on("click", function () {
    $("#dialog").dialog("option", "title", "Tambah Data Pengarang");
    $("#pengarangForm")[0].reset(); // Reset form for new data entry
    $("#pengarang_id").val(""); // Clear ID field for new entry
    x(); // Load pengarang options
    $("#dialog").dialog("open");
  });

  // Inisialisasi jsGrid dan ambil data
  $.ajax({
    url: 'fetch_data/fetch_pengarang.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      $("#jsGrid1").jsGrid({
        height: "100%",
        width: "100%",
        sorting: true,
        data: data,
        fields: [
          { name: "pengarang_id", type: "number", width: 50, title: "pengarang_id" },
          { name: "pengarang_nama", type: "text", width: 150, title: "pengarang_nama" },
          { name: "email", type: "text", width: 150, title: "email" },
          {
            name: "Aksi",
            type: "control",
            width: 100,
            itemTemplate: function(value, item) {
              var updateButton = $("<button>")
                .text("Update")
                .addClass("btn btn-primary btn-sm")
                .on("click", function() {
                  var pengarang_id = item.pengarang_id;
                  $("#dialog").dialog("option", "title", "Update Data pengarang");
                  $("#pengarang_id").val(pengarang_id);
                  $("#pengarang_nama").val(item.pengarang_nama);
                  $("#email").val(item.email);
                  $("#dialog").dialog("open");
                });

              var deleteButton = $("<button>")
                .text("Delete")
                .addClass("btn btn-danger btn-sm ml-2")
                .on("click", function() {
                  if (confirm("Apakah Anda yakin ingin menghapus pengarang ini?")) {
                    $.ajax({
                      type: "POST",
                      url: "crud/crud_pengarang.php",
                      data: { action: 'delete', pengarang_id: item.pengarang_id },
                      success: function(response) {
                        alert(response);
                        $("#jsGrid1").jsGrid("loadData");
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
          action: 'create',
          pengarang_id: $("#pengarang_id").val(),
          pengarang_nama: $("#pengarang_nama").val(),
          email: $("#email").val()
        };

        $.ajax({
          type: "POST",
          url: "crud/crud_pengarang.php",
          data: formData,
          success: function(response) {
            alert(response);
            $("#jsGrid1").jsGrid("loadData");
            $("#dialog").dialog("close");
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
