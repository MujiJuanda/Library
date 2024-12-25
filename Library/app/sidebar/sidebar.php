<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Muji Juanda Saputra</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dashboard -->
          <li class="nav-item menu-open">
            <a href="./index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- Buku -->
          <li class="nav-item">
            <a href="tablebuku.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Buku</p>
            </a>
          </li>
          <!-- Peminjaman Baru -->
          <li class="nav-item">
            <a href="tablepeminjamanbaru.php" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>Peminjaman Baru</p>
            </a>
          </li>

          <!-- Tables with Dropdown -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Koleksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tablebuku.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buku</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tablekategori.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tablepenerbit.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penerbit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tablepengarang.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengarang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="tablemember.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Member</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Peminjaman Dropdown -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Peminjaman
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tablepeminjamanbaru.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Peminjaman Baru</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tablepeminjamanaktif.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Peminjaman Aktif</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="tablepengembalian.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengembalian Tertunda</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="tablehistory.php" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>History Peminjaman</p>
            </a>
          </li>
        </ul>

        <!-- Logout Button at Bottom -->
        <ul class="nav nav-pills nav-sidebar flex-column" style="position: absolute; bottom: 20px; width: 100%;">
          <li class="nav-item">
            <a href="../index.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function() {
      // Mendapatkan semua link di sidebar
      const navLinks = document.querySelectorAll('.nav-link');

      // Mengambil URL halaman saat ini
      const currentURL = window.location.pathname;

      // Loop melalui setiap nav-link
      navLinks.forEach(link => {
         // Cek apakah href link sesuai dengan URL saat ini
         if (link.getAttribute('href') && currentURL.includes(link.getAttribute('href'))) {
            // Menghapus kelas 'active' dari semua link
            navLinks.forEach(nav => nav.classList.remove('active'));
            // Menambahkan kelas 'active' pada link yang sesuai
            link.classList.add('active');
         }
      });
    });
</script>
