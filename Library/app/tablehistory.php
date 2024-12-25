<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | History</title>
  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- jsGrid -->
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid-theme.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Include Navbar -->
  <?php include 'navbar/navbar.php'; ?>

  <!-- Include Sidebar -->
  <?php include 'sidebar/sidebar.php'; ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Buku</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel History</h3>
          <button id="btnTambahData" class="btn btn-success float-right">Tambah Data</button>
        </div>
        <div class="card-body">
          <button class="btn btn-success" id="download-pdf"><i class="fa fa-download"></i> Download PDF</button>
          <button class="btn btn-primary" id="print-table"><i class="fa fa-print"></i> Print</button>
          <div id="jsGrid1"></div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jsGrid -->
<script src="plugins/jsgrid/jsgrid.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
$(function () {
  // Load data into jsGrid
  function loadData() {
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
                var deleteButton = $("<button>")
                  .addClass("btn btn-danger btn-sm")
                  .html("<i class='fa fa-trash'></i>")
                  .on("click", function () {
                    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                      $.post("crud/crud_buku.php", { action: 'delete', id_buku: item.id_buku }, function(response) {
                        alert(response);
                        loadData();
                      });
                    }
                  });
                return deleteButton;
              }
            }
          ]
        });
      },
      error: function (xhr, status, error) {
        console.error("Error fetching data: ", error);
      }
    });
  }

  // Load data on page load
  loadData();

  // Handle download PDF
  $("#download-pdf").on("click", function () {
    const doc = new jsPDF();
    doc.text("History Data", 10, 10);

    const gridData = $("#jsGrid1").jsGrid("option", "data");
    const tableData = gridData.map(item => [
      item.id_member,
      item.nama,
      item.tgl_pinjam,
      item.tgl_kembali,
      item.buku_judul,
      item.buku_ISBN,
      item.jumlah
    ]);

    doc.autoTable({
      head: [["ID", "Nama Member", "Tanggal Pinjam", "Tanggal Kembali", "Buku Judul", "Buku ISBN", "Jumlah"]],
      body: tableData
    });

    doc.save("history-data.pdf");
  });

  // Handle print
  $("#print-table").on("click", function () {
    window.print();
  });

  // Handle tambah data button
  $("#btnTambahData").on("click", function () {
    alert("Tambah data functionality to be implemented");
  });
});
</script>
</body>
</html>
