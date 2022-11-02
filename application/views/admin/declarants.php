<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Déclarants | admin</title>
    <?= $this->load->view('inc/css', null, true); ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <?= $this->load->view('inc/sidebar', null, true); ?>

        <div class="page-container">
            <?= $this->load->view('inc/header', null, true); ?>

            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap mb-3">
                                    <h2 class="title-1">Déclarants <span class="badge badge-danger badge-pill"><?= count($declarants) ?></span> </h2>
                                    <button class="btn btn-danger">
                                        <i class="zmdi zmdi-plus-circle"></i>Ajouter</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom du déclarant</th>
                                                <th>Code du déclarant</th>
                                                <th>Email du déclarant</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $n = 1;
                                            foreach ($declarants as $el) { ?>
                                                <tr>
                                                    <td><?= $n++ ?></td>
                                                    <td><?= ucfirst($el->nomdeclarant) ?></td>
                                                    <td><?= $el->codedeclarant ?></td>
                                                    <td><?= $el->email ?></td>
                                                    <td><?= '' ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © <?= date('Y') ?> Entreposage</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?= $this->load->view('inc/js', null, true); ?>


</body>

</html>