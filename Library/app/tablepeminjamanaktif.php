<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Pinjam</title>
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
            <h1>Pinjam</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Dialog Form Pop-up
    <div id="dialog" title="Tambah Data Buku" style="display:none;">
      <form id="bukuForm">
        <div class="form-group">
          <label for="id_buku">ID Buku</label>
          <input type="text" class="form-control" id="id_buku" name="id_buku" required>
        </div>
        <div class="form-group">
          <label for="judul">Judul Buku</label>
          <input type="text" class="form-control" id="judul" name="judul" required>
        </div>
        <div class="form-group">
          <label for="penerbit">Penerbit</label>
          <select class="form-control" id="penerbit" name="penerbit" required>
            <option value="">-- Pilih Penerbit --</option>
          </select>
        </div>
        <div class="form-group">
          <label for="tgl_terbit">Tanggal Terbit</label>
          <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" required>
        </div>
        <div class="form-group">
          <label for="jml_halaman">Jumlah Halaman</label>
          <input type="number" class="form-control" id="jml_halaman" name="jml_halaman" required>
        </div>
        <div class="form-group">
          <label for="desc_buku">Deskripsi Buku</label>
          <input type="text" class="form-control" id="desc_buku" name="desc_buku" required>
        </div>
        <div class="form-group">
          <label for="harga">Harga</label>
          <input type="number" class="form-control" id="harga" name="harga" step="0.01" required>
        </div>
      </form>
    </div> -->
    

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel Pinjam</h3>
          <!-- <button id="btnTambahData" class="btn btn-success float-right">Tambah Data</button> -->
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
  // Fungsi untuk memuat data penerbit
  function loadPenerbitOptions() {
    $.ajax({
      url: 'fetch_data/fetch_penerbit.php',
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        const penerbitSelect = $('#penerbit');
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
    $("#dialog").dialog("option", "title", "Tambah Data Buku");
    $("#bukuForm")[0].reset(); // Reset form for new data entry
    $("#id_buku").val(""); // Clear ID field for new entry
    loadPenerbitOptions(); // Load penerbit options
    $("#dialog").dialog("open");
  });

  // Tombol Tambah Data
  $("#btnTambahData").on("click", function () {
    $("#dialog").dialog("option", "title", "Tambah Data Buku"); // Set judul dialog
    $("#bukuForm")[0].reset(); // Reset form sebelum input baru
    $("#dialog").dialog("open"); // Buka dialog form
  });

  // Inisialisasi jsGrid dan ambil data
  $.ajax({
    url: 'fetch_data/fetch_pinjam.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      $("#jsGrid1").jsGrid({
        height: "100%",
        width: "100%",
        sorting: true,
        data: data,
        fields: [
          { name: "id_member", type: "number", width: 50, title: "ID" },
          { name: "nama", type: "text", width: 150, title: "Nama Member" },
          { name: "tgl_pinjam", type: "date", width: 150, title: "Tanggal Pinjam" },
          { name: "tgl_kembali", type: "date", width: 100, title: "Tanggal Kembali" },
          { name: "buku_judul", type: "text", width: 80, title: "Buku Judul" },
          { name: "buku_ISBN", type: "text", width: 80, title: "Buku ISBN" },
          { name: "jumlah", type: "number", width: 80, title: "Jumlah" },
          {
            name: "Aksi",
            type: "control",
            width: 100,
            itemTemplate: function(value, item) {
              var kembalikanButton = $("<button>")
                .text("kembalikan")
                .addClass("btn btn-primary btn-sm")
                .on("click", function() {
                  // Pastikan nilai id_buku sudah ada di form dan dikirim
                  var id_buku = item.id_buku; // Pastikan id_buku yang benar

                  $("#dialog").dialog("option", "title", "kembalikan Data Buku"); // Set judul untuk kembalikan
                  $("#id_buku").val(id_buku); // Set id_buku di form

                  $("#judul").val(item.nama_buku);
                  $("#penerbit").val(item.nama_penerbit);
                  $("#tgl_terbit").val(item.buku_tglterbit);
                  $("#jml_halaman").val(item.buku_jmlhalaman);
                  $("#desc_buku").val(item.buku_deskripsi);
                  $("#harga").val(item.buku_harga);

                  $("#action").val("kembalikan");  // Pastikan action "kembalikan" dikirim

                  $("#dialog").dialog("open"); 

                  // Ketika tombol simpan (di dalam dialog) diklik, lakukan aksi kembalikan
                  $("#btnSave").off("click").on("click", function() {
                    // Mengambil data dari form
                    var id_buku = $("#id_buku").val();
                    var judul = $("#judul").val();
                    var penerbit = $("#penerbit").val();
                    var tgl_terbit = $("#tgl_terbit").val();
                    var jml_halaman = $("#jml_halaman").val();
                    var harga = $("#harga").val();

                    // Mengirimkan data kembalikan ke server menggunakan AJAX
                    $.ajax({
                      type: "POST",
                      url: "crud/crud_buku.php",
                      data: {
                        action: "kembalikan",  // Menandakan aksi kembalikan
                        id_buku: id_buku,
                        judul: judul,
                        penerbit: penerbit,
                        tgl_terbit: tgl_terbit,
                        jml_halaman: jml_halaman,
                        harga: harga
                      },
                      success: function(response) {
                        alert(response); // Menampilkan pesan setelah kembalikan
                        $("#jsGrid1").jsGrid("loadData"); // Memuat ulang data di jsGrid
                        $("#dialog").dialog("close"); // Menutup dialog setelah kembalikan
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
                  if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
                    $.ajax({
                      type: "POST",
                      url: "crud/crud_buku.php",
                      data: { action: 'delete', id_buku: item.id_buku },
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

              return $("<div>").append(kembalikanButton).append(deleteButton);
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
          id_buku: $("#id_buku").val(),
          judul: $("#judul").val(),
          penerbit: $("#penerbit").val(),
          tgl_terbit: $("#tgl_terbit").val(),
          jml_halaman: $("#jml_halaman").val(),
          desc_buku: $("#desc_buku").val(),
          harga: $("#harga").val()
        };

        $.ajax({
          type: "POST",
          url: "crud/crud_buku.php",
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
