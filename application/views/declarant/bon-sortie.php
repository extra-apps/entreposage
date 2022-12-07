<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Bons de sortie | declarant</title>
    <?= $this->load->view('inc/css', null, true); ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <?= $this->load->view('declarant/sidebar', null, true); ?>

        <div class="page-container">
            <?= $this->load->view('declarant/header', null, true); ?>

            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap mb-3">
                                    <h2 class="title-1">Bons de sortie Marchandises <span class="badge badge-danger badge-pill" nb></span> </h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-40">
                                    <table t-data class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Marchandise</th>
                                                <th>Num. sortie</th>
                                                <th>Immat.</th>
                                                <th>Qte</th>
                                                <th>Chauffeur</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $n = 1;
                                            foreach ($sortie as $e) { ?>
                                                <tr>
                                                    <td><?= $n++ ?></td>
                                                    <td><?= $e->nommarchandise ?></td>
                                                    <td><?= $e->numerosortie ?></td>
                                                    <td><?= $e->immat ?></td>
                                                    <td><?= $e->qte ?></td>
                                                    <td><?= $e->nomchauffeur ?></td>
                                                    <td><?= $e->date ?></td>
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
    <script>
        $(function() {

            
        })
    </script>

</body>

</html>