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
                                                <!-- <th>Date péremption</th> -->
                                                <th>Client</th>
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
    <div class="modal fade" id="modalvalider" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Validation quittance</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="f-valider">
                    <div class="modal-body">
                        <input type="hidden" name="idmarchandise">
                        <p>
                            <b>Voulez-vous valider la quittance de la marchandise <span id="march"></span> ?</b>
                        </p>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger">
                            <span></span>
                            Valider
                        </button>
                    </div>
                </form>
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
                        var im = e.quittance;
                        var ima = '';
                        if (im) {
                            ima = `<a href='${im}'><img src="${im}" style="width:50px;height:50px" class='image-rounded' /></a>`;
                        }
                        str += `
                        <tr>
                        <td>${i+1}</td>
                        <td>${e.nommarchandise}</td>
                        <td>${e.client}</td>
                        <td>${e.code}</td>
                        <td>${e.typemarchandise}</td>
                        <td tooltip title='${l}' class='text-center'> <span class="font-weight-bold badge text-white ${e.declare ? 'badge-success' : 'badge-danger' } p-3">${e.declare ? 'PAYÉ ' : 'NON PAYÉ' }</span></td>
                        <td>${e.declarant}</td>
                        </tr>
                        `;

                    });
                    table.find('tbody').empty().html(str);
                    $('span[nb]').html(r.length);
                    $('[tooltip]').off('tooltip').tooltip();
                    $('.valider').off('click').click(function() {
                        $('#rep').hide();
                        $('#modalvalider').modal('show');
                        $('input[name=idmarchandise]').val(this.value);
                        $('#march').html($(this).attr('marchandise'));
                    })

                })
            }

            getdata();

            $('#f-valider').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form)
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = form.serialize();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.slideUp();
                $.ajax({
                    url: '<?= site_url('json/marchandise_valider') ?>',
                    type: 'post',
                    data: data,
                    success: function(r) {
                        btn.find('span').removeClass();
                        $(':input', form).attr('disabled', false);
                        if (r.success) {
                            rep.removeClass().addClass('alert alert-success').html(r.message).slideDown();
                            getdata();
                        } else {
                            rep.removeClass().addClass('alert alert-danger').html(r.message).slideDown();
                        }
                    },
                    error: function(r) {
                        console.log(r);
                        alert("Echec reseau, la page va s'actualiser");
                        location.reload();
                    }
                });
            })
        })
    </script>

</body>

</html>