<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Accueil | déclarant <?= ucfirst($this->user->nomdeclarant) ?> </title>
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
                                    <h2 class="title-1">Marchandises <span class="badge badge-danger badge-pill" nb></span> </h2>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal">
                                        <i class="zmdi zmdi-plus-circle"></i> Declarer une marchandise</button>
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
                                                <th>Date péremption</th>
                                                <th>Client</th>
                                                <th>Code</th>
                                                <th>Type</th>
                                                <th>Etat</th>
                                                <th>Quittance</th>
                                                <th></th>
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
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nouvelle marchandise</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="f-add">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nom de la marchandise</label>
                            <input name="nommarchandise" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Client</label>
                            <select name="idclient" id="" class="form-control" required>
                                <?php foreach ($this->db->get('client')->result() as $el) { ?>
                                    <option value="<?= $el->idclient ?>"><?= $el->nomclient ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Type de la marchandise</label>
                            <input name="typemarchandise" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Code de la marchandise</label>
                            <input name="code" required class="form-control">
                        </div>
                        <?php
                        $date = date('Y-m-d', strtotime("+ 6 month"));
                        ?>
                        <div class="form-group">
                            <label for="">Date péremption</label>
                            <input name="dateexpiration" type="date" required class="form-control" value="<?= $date ?>">
                        </div>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger">
                            <span></span>
                            Déclarer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaldeclare" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Déclaration de la marchandise</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="f-declare">
                    <div class="modal-body">
                        <input type="hidden" name="idmarchandise">
                        <div class="form-group">
                            <label for="">Nom de la marchandise</label>
                            <input id="march" disabled class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Numero declaration</label>
                            <input name="numero_declaration" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Numero liquidation</label>
                            <input name="numero_liquidation" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Quantité</label>
                            <input name="qte" required class="form-control" type="number" min="1">
                        </div>
                        <div class="form-group">
                            <label for="">Image quittance (.png,.jpg,.jpeg)</label>
                            <input accept=".png,.jpg,.jpeg" type="file" class="form-control" name="file" required>
                        </div>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger">
                            <span></span>
                            Payer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= $this->load->view('inc/js', null, true); ?>
    <script>
        $(function() {

            $('#f-add').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form)
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = $(form).serialize();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.slideUp();
                $.ajax({
                    url: '<?= site_url('json/marchandise') ?>',
                    type: 'post',
                    data: data,
                    success: function(r) {
                        btn.find('span').removeClass();
                        $(':input', form).attr('disabled', false);
                        if (r.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success').html(r.message).slideDown();
                            getdata();
                        } else {
                            rep.removeClass().addClass('alert alert-danger').html(r.message).slideDown();
                        }
                    },
                    error: function(r) {
                        console.error(r);
                        alert("Echec reseau, la page va s'actualiser");
                        location.reload();
                    }
                });
            })

            $('#f-declare').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form)
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = new FormData(this);
                console.log(data);
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.slideUp();
                $.ajax({
                    url: '<?= site_url('json/marchandise_declare') ?>',
                    type: 'post',
                    data: data,
                    processData: false,
                    contentType: false,
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
                        console.error(r);
                        alert("Echec reseau, la page va s'actualiser");
                        location.reload();
                    }
                });
            })


            function getdata() {
                var table = $('[t-data]');
                $.getJSON('<?= site_url('json/marchandise_get') ?>', function(r) {
                    var str = '';
                    $(r).each(function(i, e) {
                        var im = e.quittance;
                        var ima = '';
                        if (im) {
                            ima = `<a href='${im}'><img src="${im}" style="width:50px;height:50px" class='image-rounded' /></a>`;
                        }
                        str += `
                        <tr>
                        <td>${i+1}</td>
                        <td>${e.nommarchandise}</td>
                        <td>${e.dateexpiration}</td>
                        <td>${e.client}</td>
                        <td>${e.code}</td>
                        <td>${e.typemarchandise}</td>
                        <td class='text-center'> <span class="font-weight-bold badge text-white ${e.declare ? 'badge-success' : 'badge-danger' } p-3">${e.declare ? 'PAYÉ ' : 'NON PAYÉ' }</span></td>
                        <td>
                            ${ima}
                        </td>
                        <td>
                            ${e.declare ? '' : "<button marchandise='"+e.nommarchandise+"' class='btn btn-outline-danger declare' value='"+e.idmarchandise+"' >Déclarer</button>"}
                        </td>
                        </tr>
                        `;
                    });
                    table.find('tbody').empty().html(str);
                    $('span[nb]').html(r.length);
                    $('.declare').off('click').click(function() {
                        $('#modaldeclare').modal('show');
                        $('input[name=idmarchandise]').val(this.value);
                        $('#march').val($(this).attr('marchandise'));
                    })
                })
            }

            getdata();
        })
    </script>

</body>

</html>