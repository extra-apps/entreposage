<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Connexion</title>

    <link href="<?= base_url('assets/') ?>css/font-face.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <link href="<?= base_url('assets/') ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <link href="<?= base_url('assets/') ?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <link href="<?= base_url('assets/') ?>css/theme.css" rel="stylesheet" media="all">
    <style>
        .login-wrap {
            max-width: 400px;
        }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content carte" style="border-radius: 20px;">
                        <div class="login-logo">
                            <a href="#">
                                <img src="<?= base_url('assets/') ?>images/logo.png" width="200px" height="200px" alt="">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="<?= site_url('app/connexion') ?>" method="post">
                                <div class="form-group">
                                    <input required class="au-input au-input--full" name="login" placeholder="Email ou telephone">
                                </div>
                                <div class="form-group">
                                    <input required class="au-input au-input--full" type="password" name="pass" placeholder="Mot de passe">
                                </div>
                                <?php if ($this->session->message) : ?>
                                    <div class="form-group">
                                        <div class="alert alert-danger">
                                            <h5><?= $this->session->message; ?></h5>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <button class="btn btn-block btn-danger m-b-20" type="submit">connexion</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="<?= base_url('assets/') ?>vendor/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/slick/slick.min.js">
    </script>
    <script src="<?= base_url('assets/') ?>vendor/wow/wow.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/animsition/animsition.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?= base_url('assets/') ?>vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?= base_url('assets/') ?>vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/select2/select2.min.js">
    </script>
    <script src="<?= base_url('assets/') ?>js/main.js"></script>

</body>

</html>