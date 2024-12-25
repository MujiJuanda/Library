<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Penerbit</title>
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
            <h1>Penerbit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penerbit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Dialog Form Pop-up -->
    <div id="dialog" title="Tambah Data Penerbit" style="display:none;">
      <form id="penerbitForm">
        <div class="form-group">
          <label for="penerbit_id">ID Penerbit</label>
          <input type="text" class="form-control" id="penerbit_id" name="penerbit_id" required>
        </div>
        <div class="form-group">
          <label for="penerbit_nama">Nama Penerbit</label>
          <input type="text" class="form-control" id="penerbit_nama" name="penerbit_nama" required>
        </div>
      </form>
    </div>
    

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel Penerbit</h3>
          <button id="btnTambahData" class="btn btn-success float-right">Tambah Data</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="jsGrid1"></div>
        </div>
        <!-- /.card-body -->
         <!-- <div class="card-body">
          <table id="penerbitTable" class="table">
            <thead>
              <tr>
                <th>ID Penerbit</th>
                <th>Nama Penerbit</th>
              </tr>
            </thead>
            <tbody> -->
              <!-- Data from database will be inserted here-->
            </tbody>
          </table>
         </div>
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
  // Fungsi untuk memuat data penerbit
  function loadPenerbitOptions() {
    $.ajax({
      url: 'fetch_data/fetch_penerbit.php',
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        const penerbitSelect = $('#penerbit_id');
        penerbitSelect.empty(); // Kosongkan dropdown terlebih dahulu
        penerbitSelect.append('<option value="">-- Pilih Penerbit --</option>'); // Tambahkan opsi default
        data.forEach(function (item) {
          penerbitSelect.append(`<option value="${item.penerbit_id}">${item.penerbit_id} - ${item.penerbit_nama}</option>`);
        });
      },
      error: function (xhr, status, error) {
        console.error("Error fetching penerbit data:", status, error);
      }
    });
  }

  // Panggil fungsi loadPenerbitOptions saat halaman dimuat
  loadPenerbitOptions();
  
  // Open Dialog and Load Penerbit Data
  $("#btnTambahData").on("click", function () {
    $("#dialog").dialog("option", "title", "Tambah Data Penerbit");
    $("#penerbitForm")[0].reset(); // Reset form for new data entry
    $("#penerbit_id").val(""); // Clear ID field for new entry
    loadPenerbitOptions(); // Load penerbit options
    $("#dialog").dialog("open");
  });

  // Tombol Tambah Data
  $("#btnTambahData").on("click", function () {
    $("#dialog").dialog("option", "title", "Tambah Data Penerbit"); // Set judul dialog
    $("#penerbitForm")[0].reset(); // Reset form sebelum input baru
    $("#dialog").dialog("open"); // Buka dialog form
  });

  // Inisialisasi jsGrid dan ambil data
  $.ajax({
    url: 'fetch_data/fetch_penerbit.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      $("#jsGrid1").jsGrid({
        height: "100%",
        width: "100%",
        sorting: true,
        data: data,
        fields: [
          { name: "penerbit_id", type: "number", width: 50, title: "ID" },
          { name: "penerbit_nama", type: "text", width: 150, title: "Nama Penerbit" },
          {
            name: "Aksi",
            type: "control",
            width: 100,
            itemTemplate: function(value, item) {
              var updateButton = $("<button>")
                .text("Update")
                .addClass("btn btn-primary btn-sm")
                .on("click", function() {
                  // Pastikan nilai penerbit_id sudah ada di form dan dikirim
                  var penerbit_id = item.penerbit_id; // Pastikan penerbit_id yang benar

                  $("#dialog").dialog("option", "title", "Update Data Penerbit"); // Set judul untuk update
                  $("#penerbit_id").val(penerbit_id); // Set penerbit_id di form

                  $("#penerbit_nama").val(item.penerbit_nama);

                  $("#action").val("update");  // Pastikan action "update" dikirim

                  $("#dialog").dialog("open"); 

                  // Ketika tombol simpan (di dalam dialog) diklik, lakukan aksi update
                  $("#btnSave").off("click").on("click", function() {
                    // Mengambil data dari form
                    var penerbit_id = $("#penerbit_id").val();
                    var penerbit_nama = $("#penerbit_nama").val();
                    $.ajax({
                      url: 'crud/crud_penerbit.php',
                      type: 'GET',
                      data: { penerbit_id, penerbit_nama},
                      success: function(response) {
                        console.log(response);
                        location.reload(); 
                      }
                    });
                  });
                });
              return updateButton;
            }
          }
        ]
      });
    }
  });

  // Open dialog for new data entry
  $("#dialog").dialog({
    autoOpen: false,
    width: 400,
    buttons: [
      {
        text: "Save",
        click: function () {
          var formData = {
            action: 'create',
            penerbit_id: $("#penerbit_id").val(),
            penerbit_nama: $("#penerbit_nama").val()
          }

          $.ajax({
          type: "POST",
          url: "crud/crud_penerbit.php",
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
          $.ajax({
            url: 'fetch_data/fetch_penerbit.php',
            type: 'GET',
            data: {
              penerbit_id: penerbit_id,
              penerbit_nama: penerbit_nama,
            },
            success: function (response) {
              console.log(response);
              location.reload(); 
            }
          });
          $(this).dialog("close");
        }
      },
      {
        text: "Cancel",
        click: function () {
          $(this).dialog("close");
        }
      }
    ]
  });
});
</script>
</body>
</html>
