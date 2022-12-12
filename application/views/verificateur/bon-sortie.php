<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Bons de sortie | verificateur</title>
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
                                    <h2 class="title-1">Bons de sortie Marchandises <span class="badge badge-danger badge-pill" nb></span> </h2>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal">
                                        <i class="zmdi zmdi-plus-circle"></i> Enregistrer</button>
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
                                                <th></th>
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
                                                    <td><button value="<?= $e->idsortie ?>" class="btn btn-outline-danger bdel"><i class="fa fa-trash"></i></button></td>

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
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nouveau bon de sortie</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="f-add">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Marchandise</label>
                            <select name="idmarchandise" id="" required class="form-control">
                                <?php foreach ($marchandises as $e) { ?>
                                    <option value="<?= $e->idmarchandise ?>"><?= "$e->nommarchandise (qte: $e->qte)" ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Qte sortie</label>
                            <input name="qte" required class="form-control" type="number" min="1">
                        </div>
                        <div class="form-group">
                            <label for="">Numero sortie</label>
                            <input name="numerosortie" required class="form-control telephone">
                        </div>
                        <div class="form-group">
                            <label for="">Immat</label>
                            <input name="immat" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Chauffeur</label>
                            <input name="nomchauffeur" required class="form-control">
                        </div>
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
    <div class="modal fade" id="modaldel" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Suppresion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="f-del">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>Voulez-vous vraiment supprimé ?</p>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                        <button type="submit" class="btn btn-danger">
                            <span></span>
                            OUI
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
                    url: '<?= site_url('json/sortie') ?>',
                    type: 'post',
                    data: data,
                    success: function(r) {
                        btn.find('span').removeClass();
                        $(':input', form).attr('disabled', false);
                        if (r.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success').html(r.message).slideDown();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
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

            $('.bdel').off('click').click(function() {
                var modal = $('#modaldel');
                $('[name=id]', $('#f-del')).val(this.value);
                modal.modal();
            })

            $('#f-del').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form)
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = $(form).serialize();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.slideUp();
                $.ajax({
                    url: '<?= site_url('json/sortie_del') ?>',
                    type: 'post',
                    data: data,
                    success: function(r) {
                        btn.find('span').removeClass();
                        $(':input', form).attr('disabled', false);
                        if (r.success) {
                            rep.removeClass().addClass('alert alert-success').html(r.message).slideDown();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
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
        })
    </script>

</body>

</html>