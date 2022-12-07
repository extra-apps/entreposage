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
                    <a href="<?= site_url('verificateur') ?>">
                        <i class="fas fa-recycle  "></i>Marchandises</a>
                </li>
                <li>
                    <a href="<?= site_url('verificateur/bon-entree') ?>">
                        <i class="fas fa-plus-square"></i>Bons d'entrée</a>
                </li>
                <li>
                    <a href="<?= site_url('verificateur/bon-sortie') ?>">
                        <i class="fa fa-list"></i>Bons de sortie</a>
                </li>
                <li>
                    <a href="<?= site_url('verificateur/valider-quittance') ?>">
                        <i class="fa fa-check-circle"></i>Valider quittance</a>
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
                    <a href="<?= site_url('verificateur') ?>">
                        <i class="fas fa-recycle  "></i>Marchandises</a>
                </li>
                <li>
                    <a href="<?= site_url('verificateur/bon-entree') ?>">
                        <i class="fas fa-plus-square"></i>Bons d'entrée</a>
                </li>
                <li>
                    <a href="<?= site_url('verificateur/bon-sortie') ?>">
                        <i class="fa fa-list"></i>Bons de sortie</a>
                </li>
                <li>
                    <a href="<?= site_url('verificateur/valider-quittance') ?>">
                        <i class="fa fa-check-circle"></i>Valider quittance</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>