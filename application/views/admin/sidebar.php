<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a href="#" class="logo">
                    <img class="m-2" src="<?= base_url('assets/') ?>images/logo.png" width="200px" height="200px" alt="">
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a href="<?= site_url('admin') ?>">
                        <i class="fas fa-chart-bar"></i>Tableau de bord</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/marchandises') ?>">
                        <i class="fas fa-list"></i>Marchandises</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/clients') ?>">
                        <i class="fas fa-users"></i>Clients</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/verificateurs') ?>">
                        <i class="far fa-check-square"></i>Vérificateurs</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/declarants') ?>">
                        <i class="fas fa-calendar-alt"></i>Déclarants</a>
                </li>

            </ul>
        </div>
    </nav>
</header>

<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img class="m-2" src="<?= base_url('assets/') ?>images/logo.png" width="200px" height="200px" alt="">
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="<?= site_url('admin') ?>">
                        <i class="fas fa-chart-bar"></i>Tableau de bord</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/marchandises') ?>">
                        <i class="fas fa-list"></i>Marchandises</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/clients') ?>">
                        <i class="fas fa-users"></i>Clients</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/verificateurs') ?>">
                        <i class="far fa-check-square"></i>Vérificateurs</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/declarants') ?>">
                        <i class="fas fa-calendar-alt"></i>Déclarants</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>