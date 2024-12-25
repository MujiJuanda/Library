<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan | Peminjaman</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
    .form-group {
      margin-bottom: 15px;
    }

    .card-header h3 {
      font-weight: bold;
    }

    .table-container {
      margin-top: 20px;
    }

    .suggestion-box {
      position: absolute;
      background: #fff;
      border: 1px solid #ccc;
      z-index: 1000;
      width: 100%;
      max-height: 150px;
      overflow-y: auto;
    }
    .suggestion {
      padding: 5px;
      cursor: pointer;
    }
    .suggestion:hover {
      background-color: #f0f0f0;
    }

  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include 'navbar/navbar.php'; ?>

    <!-- Sidebar -->
    <?php include 'sidebar/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">

      <!-- Page Header -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Peminjaman Buku</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Peminjaman</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <!-- Main Content -->
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Formulir Peminjaman</h3>
          </div>

          <div class="card-body">
            <form id="formPeminjaman">
              <!-- Member Info -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id_member">ID Member</label>
                    <input type="text" class="form-control" id="id_member" placeholder="Masukkan ID Member" required>
                    <input type="hidden" id="id_member">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama">Nama Member</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Member" required>
                    <input type="hidden" id="nama">
                  </div>
                </div>
              </div>

              <!-- Tanggal -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tgl_peminjaman">Tanggal Pinjam</label>
                    <input type="date" class="form-control datepicker" id="tgl_peminjaman" placeholder="Pilih Tanggal Pinjam" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tgl_kembali">Tanggal Kembali</label>
                    <input type="date" class="form-control datepicker" id="tgl_kembali" placeholder="Pilih Tanggal Kembali" required>
                  </div>
                </div>
              </div>

              <!-- Buku Section -->
              <div class="table-container">
                <table class="table table-bordered" id="tabelBuku">
                  <thead>
                    <tr>
                      <th>Nama Buku</th>
                      <th>ID Buku</th>
                      <th>Jumlah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Rows will be added via JavaScript -->
                    <tr>
                      <td>
                        <input type="text" class="form-control nama-buku" placeholder="Masukkan Nama Buku" required>
                        <input type="hidden" class="id-buku">
                      </td>
                      <td><input type="text" class="form-control id-buku" placeholder="ID Buku Otomatis" readonly></td>
                      <td>
                        <input type="number" class="form-control jumlah-buku" value="1" min="1" required>
                      </td>
                      <td>
                        <button type="button" class="btn btn-primary btnTambahInput">+ Buku</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- Add Book Button -->
              <div class="form-group">
                <button type="button" class="btn btn-primary btnTambahInput">+ Tambah Buku</button>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-success mt-3">Simpan</button>
            </form>
          </div>
        </div>
      </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

  </div>

  <!-- Scripts -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function () {
      // Inisialisasi Datepicker
      $('.datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: { format: 'YYYY-MM-DD' }
      }).on('apply.daterangepicker', function (e, picker) {
        const tglPinjam = picker.startDate;
        const tglKembali = moment(tglPinjam).add(14, 'days').format('YYYY-MM-DD');
        $('#tgl_kembali').val(tglKembali);
      });

      // Tambahkan baris baru ke tabel buku
      $(document).on('click', '.btnTambahInput', function () {
        const row = `
          <tr>
            <td>
              <input type="text" class="form-control nama-buku" placeholder="Masukkan Nama Buku" required>
              <input type="hidden" class="id-buku">
            </td>
            <td><input type="text" class="form-control id-buku" placeholder="ID Buku Otomatis" readonly></td>
            <td><input type="number" class="form-control jumlah-buku" value="1" min="1" required></td>
            <td><button type="button" class="btn btn-danger btn-sm hapus-buku">Hapus</button></td>
          </tr>`;
        $('#tabelBuku tbody').append(row);
      });

      // Hapus baris dari tabel buku
      $(document).on('click', '.hapus-buku', function () {
        $(this).closest('tr').remove();
      });

      // Input nama member dengan rekomendasi
      $('#nama').on('input', function () {
        const input = $(this);
        const query = input.val();

        if (query.length > 2) {
          $.ajax({
            url: 'fetch_data/fetch_member.php',
            method: 'GET',
            data: { q: query },
            success: function (response) {
              const data = JSON.parse(response);
              let suggestions = '';

              data.forEach(item => {
                suggestions += `<div class="suggestion-member" data-id="${item.id_member}" data-name="${item.nama}">${item.nama}</div>`;
              });

              const suggestionBox = $('<div class="suggestion-box"></div>').html(suggestions);
              input.siblings('.suggestion-box').remove(); // Hapus box lama
              input.after(suggestionBox); // Tambahkan box baru
            },
            error: function (xhr, status, error) {
              console.error('Error:', error);
            }
          });
        } else {
          input.siblings('.suggestion-box').remove(); // Hapus box jika query kosong
        }
      });

      // Pilih member dari suggestion
      $(document).on('click', '.suggestion-member', function () {
        const selected = $(this);
        $('#nama').val(selected.data('name'));
        $('#id_member').val(selected.data('id'));
        $('.suggestion-box').remove(); // Hapus box setelah memilih
      });

      // Input nama buku dengan rekomendasi
      $(document).on('input', '.nama-buku', function () {
        const input = $(this);
        const query = input.val();

        if (query.length > 2) {
          $.ajax({
            url: 'fetch_data/fetch_buku.php',
            method: 'GET',
            data: { q: query },
            success: function (response) {
              const data = JSON.parse(response);
              let suggestions = '';

              data.forEach(item => {
                suggestions += `<div class="suggestion" data-id="${item.id_buku}" data-name="${item.nama_buku}">${item.nama_buku}</div>`;
              });

              const suggestionBox = $('<div class="suggestion-box"></div>').html(suggestions);
              input.siblings('.suggestion-box').remove(); // Hapus box lama
              input.after(suggestionBox); // Tambahkan box baru
            },
            error: function (xhr, status, error) {
              console.error('Error:', error);
            }
          });
        } else {
          input.siblings('.suggestion-box').remove(); // Hapus box jika query kosong
        }
      });

      // Pilih buku dari suggestion
      $(document).on('click', '.suggestion', function () {
        const selected = $(this);
        const input = selected.closest('td').find('.nama-buku');
        const idInput = selected.closest('tr').find('.id-buku');

        input.val(selected.data('name'));
        idInput.val(selected.data('id'));
        $('.suggestion-box').remove(); // Hapus box setelah memilih
      });

      // Validasi form
      $('#formPeminjaman').submit(function (e) {
        e.preventDefault();
        let valid = true;
        let errorMessage = '';

        if ($('#id_member').val() === '') {
          valid = false;
          errorMessage += 'ID Member harus diisi.\n';
        }

        $('#tabelBuku tbody tr').each(function () {
          const namaBuku = $(this).find('.nama-buku').val();
          if (namaBuku === '') {
            valid = false;
            errorMessage += 'Nama buku tidak boleh kosong.\n';
          }
        });

        if (!valid) {
          alert(errorMessage);
          return;
        }

        // Kirim data jika valid
        alert('Data peminjaman berhasil disimpan!');
      });
    });
  </script>

</body>

</html>
