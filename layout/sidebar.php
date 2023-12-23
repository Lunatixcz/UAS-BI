<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username'] ; ?></a>
        </div>
      </div>

      <?php 
      $hak_akses = isset($_SESSION["hak_akses"]) ? $_SESSION["hak_akses"]  : '';

      function isPageActive($linkURL){
        $currentUrl = $_GET["module"];
        return($currentUrl == $linkURL);
      }

      if ($hak_akses =='Super Admin') { ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="?module=beranda" class="nav-link <?php echo isPageActive('beranda') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
                </a>
               </li>
               <li class="nav-item ">
                <a href="javascript:void(0);" class="nav-link <?php echo isPageActive('master') ? 'active' : ''; ?>">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                    Master
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?module=dataItem" class="nav-link <?php echo isPageActive('dataItem') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Barang</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?module=dataSup" class="nav-link <?php echo isPageActive('dataSup') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Supplier</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?module=dataCust" class="nav-link <?php echo isPageActive('dataCust') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Customer</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?module=pihakJasa" class="nav-link <?php echo isPageActive('pihakJasa') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pihak Jasa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?module=dataJasa" class="nav-link <?php echo isPageActive('dataJasa') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Jasa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?module=dataMobil" class="nav-link <?php echo isPageActive('dataMobil') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Mobil</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?module=noAcc" class="nav-link <?php echo isPageActive('noAcc') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Nomor Akun</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class = "nav-item">
              <a href="javascript:void(0);" class="nav-link <?php echo isPageActive('transaksi') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-wallet"></i>
                    <p>
                      Transaksi
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?module=buyItem" class="nav-link <?php echo isPageActive('buyItem') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pembelian Barang</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?module=sellItem" class="nav-link <?php echo isPageActive('sellItem') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Penjualan Barang</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class = "nav-item">
              <a href="javascript:void(0);" class="nav-link <?php echo isPageActive('mobil') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-truck"></i>
                    <p>
                      Mobil
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?module=cekMobil" class="nav-link <?php echo isPageActive('cekMobil') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pengecekan Mobil</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class = "nav-item">
              <a href="javascript:void(0);" class="nav-link <?php echo isPageActive('transaksi') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>
                      Cash
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?module=cashMasuk" class="nav-link <?php echo isPageActive('buyItem') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pemasukan Cash Harian</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="?module=cashKeluar" class="nav-link <?php echo isPageActive('sellItem') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pengeluaran Cash Harian</p>
                    </a>
                  </li>
                </ul>
            </li>

            <li class = "nav-item">
              <a href="javascript:void(0);" class="nav-link <?php echo isPageActive('laporan') ? 'active' : ''; ?>">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                      Laporan
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="?module=sellReport" class="nav-link <?php echo isPageActive('sellReport') ? 'active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Laporan Excel</p>
                    </a>
                  </li>
                </ul>
            </li>
          <li class="nav-item">
              <a href="?module=User" class="nav-link <?php echo isPageActive('User') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                  User
              </p>
              </a>
              </li>  
    <?php
      }
    ?>