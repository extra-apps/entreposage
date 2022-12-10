<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Parametre notification | admin</title>
    <?= $this->load->view('inc/css', null, true); ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <?= $this->load->view('admin/sidebar', null, true); ?>

        <div class="page-container">
            <?= $this->load->view('admin/header', null, true); ?>

            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap mb-3">
                                    <h2 class="title-1">Notifications </h2>
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
                                                <th>Nom parametre</th>
                                                <th>Contenu</th>
                                                <th>Clients</th>
                                                <th>Date d'envoi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $n = 1;
                                            foreach ($this->db->order_by('idparametre', 'desc')->get('parametre')->result() as $e) {
                                                $cl = '';
                                                foreach ($this->db->where_in('idclient', (array) json_decode($e->reglage))->get('client')->result() as $c) {
                                                    $cl .= "{$c->nomclient}, ";
                                                }

                                                $co = $e->contenu;
                                                if (strlen($co) > 60) {
                                                    $co = substr($co, 0, 60) . " ...";
                                                }
                                            ?>
                                                <tr>
                                                    <td><?= $n++ ?></td>
                                                    <td><?= $e->nomparametre ?></td>
                                                    <td data-toggle="tooltip" title="<?= $e->contenu ?>"><?= $co ?></td>
                                                    <td><?= $cl ?></td>
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
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Nouvelle notification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="f-add">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nom parametre</label>
                            <input name="nomparametre" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Contenu</label>
                            <textarea name="contenu" id="" class="form-control" maxlength="600"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Date d'envoi</label>
                            <input name="date" required class="form-control" type="date" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Client</label>
                            <select name="idclient[]" multiple required class="form-control chosen-select">
                                <?php foreach ($this->db->get('client')->result() as $e) { ?>
                                    <option value="<?= $e->idclient ?>"><?= $e->nomclient ?></option>
                                <?php } ?>
                            </select>
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
    <?= $this->load->view('inc/js', null, true); ?>
    <script src="<?= base_url('assets/chosen/chosen.jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/chosen/chosen.min.css') ?>">
    <style>
        .chosen-container {
            width: 100% !important
        }
    </style>
    <script>
        $(function() {
            $(".chosen-select").chosen();

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
                    url: '<?= site_url('json/notif') ?>',
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
                            }, 5000);
                        } else {
                            rep.removeClass().addClass('alert alert-danger').html(r.message).slideDown();
                        }
                    },
                    error: function(r) {
                        alert("Echec reseau, la page va s'actualiser");
                        location.reload();
                    }
                });
            })
        })
    </script>

</body>

</html>