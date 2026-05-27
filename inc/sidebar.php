<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo pt-2">
        <a href="index.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <!-- <img src="./inc/logo_laundry.svg" width="150" alt="logo"> -->
                <img width="30" src="./washing-machine.png" alt="logo">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Laundry</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>


        <?php if ($_SESSION['id_level'] == 1): ?>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-folder"></i>
                    <div data-i18n="Account Settings">Master Data</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="user.php" class="menu-link">
                            <div data-i18n="Account">Data User</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="level.php" class="menu-link">
                            <div data-i18n="Account">Level</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="customer.php" class="menu-link">
                            <div data-i18n="Notifications">Customer</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="paket.php" class="menu-link">
                            <div data-i18n="Connections">Paket</div>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif ?>

        <?php if ($_SESSION['id_level'] == 1 or $_SESSION['id_level'] == 2): ?>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-wallet"></i>
                    <div data-i18n="Authentications">Transaksi</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="trans-order.php" class="menu-link">
                            <div data-i18n="Basic">Data Transaksi</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="trans-pickup.php" class="menu-link">
                            <div data-i18n="Basic">Transaksi Pengembalian</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="laporan.php" class="menu-link">
                            <div data-i18n="Basic">Laporan Transaksi</div>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif ?>
    </ul>
</aside>