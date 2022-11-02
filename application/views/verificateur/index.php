<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Marchandises | verificateur</title>
    <?= $this->load->view('inc/css', null, true); ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <?= $this->load->view('verificateur/sidebar', null, true); ?>

        <div class="page-container">
            <?= $this->load->view('verificateur/header', null, true); ?>

            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap mb-3">
                                    <h2 class="title-1">Marchandises <span class="badge badge-danger badge-pill" nb></span> </h2>
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
                                                <th>Code</th>
                                                <th>Type</th>
                                                <th>Etat</th>
                                                <th>Déclarant</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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

            function getdata() {
                var table = $('[t-data]');
                $.getJSON('<?= site_url('json/marchandise_get') ?>', function(r) {
                    var str = '';
                    $(r).each(function(i, e) {
                        var l = '';
                        if (e.declare) {
                            l = "Date declaration : " + e.date + "\nNumero liquidation : " + e.numero_liquidation + "\nNumero declaration : " + e.numero_declaration;
                        }
                        str += `
                        <tr>
                        <td>${i+1}</td>
                        <td>${e.nommarchandise}</td>
                        <td>${e.code}</td>
                        <td>${e.typemarchandise}</td>
                        <td tooltip title='${l}' class="font-weight-bold text-white ${e.declare ? 'bg-success' : 'bg-danger' }">${e.declare ? 'DECLARE' : 'NON DECLARE' }</td>
                        <td>${e.declarant}</td>
                        </tr>
                        `;
                    });
                    table.find('tbody').empty().html(str);
                    $('span[nb]').html(r.length);
                    $('[tooltip]').off('tooltip').tooltip()

                })
            }

            getdata();
        })
    </script>

</body>

</html>