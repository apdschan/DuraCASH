<!DOCTYPE html>
<html lang="en">
<style>
    .material-symbols-light--work-history-outline {
  display: inline-block;
  width: 1em;
  height: 1em;
  --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M4 19V8zm.615 1q-.69 0-1.152-.462Q3 19.075 3 18.385v-9.77q0-.69.463-1.152Q3.925 7 4.615 7H9V5.615q0-.69.463-1.152Q9.925 4 10.615 4h2.77q.69 0 1.153.463q.462.462.462 1.152V7h4.385q.69 0 1.152.463q.463.462.463 1.152v4.198q-.238-.151-.479-.264q-.24-.112-.521-.21V8.614q0-.269-.173-.442T19.385 8H4.615q-.269 0-.442.173T4 8.615v9.77q0 .269.173.442t.442.173h7.46q.056.275.12.515q.063.24.153.485zM10 7h4V5.615q0-.269-.173-.442T13.385 5h-2.77q-.269 0-.442.173T10 5.615zm8 15q-1.671 0-2.836-1.164T14 18q0-1.671 1.164-2.836T18 14q1.671 0 2.836 1.164T22 18q0 1.671-1.164 2.836T18 22m.385-4.162v-2.723h-.77v3.047l2.035 2.034l.546-.546z'/%3E%3C/svg%3E");
  background-color: currentColor;
  -webkit-mask-image: var(--svg);
  mask-image: var(--svg);
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
}
</style>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="<?php echo base_url("assets/img/logo.png")?>" alt="">
            <a href="<?php echo base_url("admin/dashboard/" . $data_admin->UserID)?>" >DuraCASH</a>
        </div>

        <div class="account-section">
            <a href="<?php echo base_url("admin/akun/" . $data_admin->UserID)?>" >
            <img src="<?php echo base_url("assets/img/account.png")?>" alt="Account Image"></a>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div id="sidebar" class="sidenav">
        <div class="sidebar-item" tabindex="0">
            <a href="<?php echo base_url("admin/dashboard/" . $data_admin->UserID)?>">
                <i class="ion-ios-home-outline ion-2x"></i>
                Dashboard
            </a>
        </div>

        <div class="sidebar-item">
            <a href="<?php echo base_url("admin/kasirpelanggan/" . $data_admin->UserID)?>">
                <i class="ion-ios-people-outline ion-2x"></i>
                Pelanggan & Kasir
            </a>
        </div>

        <div class="sidebar-item">
            <a href="<?php echo base_url("admin/produk/" . $data_admin->UserID)?>">
                <i class="ion-bag ion-2x"></i>
                Produk
            </a>
        </div>

        <div class="sidebar-item">
            <a href="<?php echo base_url("admin/kategori/" . $data_admin->UserID)?>">
                <i class="ion-ios-list-outline ion-2x"></i>
                Kategori
            </a>
        </div>

        <div class="sidebar-item">
            <a href="<?php echo base_url("admin/toko/" . $data_admin->UserID)?>">
                <i class="ion-ios-cart-outline ion-2x"></i>
                Toko
            </a>
        </div>

        <div class="sidebar-item">
            <a href="<?php echo base_url("admin/laporan/" . $data_admin->UserID)?>">
                <i class="ion-ios-paper-outline ion-2x"></i>
                Laporan
            </a>
        </div>

        <div class="sidebar-item">
            <a href="<?php echo base_url("admin/riwayatTransaksi/" . $data_admin->UserID)?>">
                <i class="material-symbols-light--work-history-outline"></i>
                Laporan Transaksi
            </a>
        </div>

        <div class="logout-button">
            <a href="<?php echo base_url("user/login/logout")?>">
                <i class="ion-log-out ion-2x"></i>
                Logout
            </a>
        </div>

    </div>

    <!-- Page Content -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
