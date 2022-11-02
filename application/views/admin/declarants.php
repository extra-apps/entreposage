<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Déclarants | admin</title>
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
                                    <h2 class="title-1">Déclarants <span class="badge badge-danger badge-pill" nb></span> </h2>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal">
                                        <i class="zmdi zmdi-plus-circle"></i>Ajouter</button>
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
                                                <th>Nom du déclarant</th>
                                                <th>Code du déclarant</th>
                                                <th>Email du déclarant</th>
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
                    <h4>Nouveau déclarant</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="f-add">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nom du declarant</label>
                            <input name="nomdeclarant" required class="form-control" placeholder="Nom du declarant">
                        </div>
                        <div class="form-group">
                            <label for="">Code du declarant</label>
                            <input name="codedeclarant" required class="form-control" placeholder="Code du declarant" value="<?= rand(10000, 99999) ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Email du declarant</label>
                            <input name="email" required class="form-control" placeholder="Email du declarant">
                        </div>
                        <div class="form-group">
                            <label for="">Mot de passe</label>
                            <div class="d-flex ">
                                <input type="password" name="mdp" value="123456" class="form-control w-100" placeholder="Mot de passe" required>
                                <div class="input-group-addon show_hide_password" style="cursor: pointer">
                                    <a href="#"><i class="text-danger fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger">
                            <span></span>
                            Ajouter
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
                var rep = $('#rep');
                rep.slideUp();
                $.ajax({
                    url: '<?= site_url('json/declarant') ?>',
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

            function getdata() {
                var table = $('[t-data]');
                $.getJSON('<?= site_url('json/declarant_get') ?>', function(r) {
                    var str = '';
                    $(r).each(function(i, e) {
                        str += `
                        <tr>
                        <td>${i+1}</td>
                        <td>${e.nomdeclarant}</td>
                        <td>${e.codedeclarant}</td>
                        <td>${e.email}</td>
                        <td></td>
                        </tr>
                        `;
                    });
                    table.find('tbody').empty().html(str);
                    $('span[nb]').html(r.length);
                })
            }

            getdata();
        })
    </script>

</body>

</html>