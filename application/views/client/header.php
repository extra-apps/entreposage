<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">

                </form>
                <div class="header-button">
                    <div class="noti-wrap">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <span class="quantity" id="nbnotif" ></span>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p notif ></p>
                                </div>
                                <div notifzone style="max-height: 500px; overflow-y: auto;" ></div>
                            </div>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="content">
                                <a class="js-acc-btn" href="#"> <?= ucfirst($this->user->nomclient) ?> </a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="account-dropdown__footer">
                                    <a href="<?= site_url('app/deconnexion') ?>">
                                        <i class="zmdi zmdi-power"></i>Déconnexion</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>