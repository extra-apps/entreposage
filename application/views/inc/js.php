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
<script>
    $(function() {
        var current_url = location.href;
        var cu = current_url.split("?");
        current_url = cu[0];
        $(`a[href='${current_url}']`).closest("li").addClass("active");
        $(".show_hide_password").on('click', function(event) {
            event.preventDefault();
            var div = $(this);
            event.preventDefault();
            if (div.prev().attr("type") == "text") {
                div.prev().attr('type', 'password');
                div.find('i').removeClass("fa-eye").addClass("fa-eye-slash");
            } else if (div.prev().attr("type") == "password") {
                div.prev().attr('type', 'text');
                div.find('i').removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        <?php if ($this->session->idclient) { ?>
            getNotif = function() {
                $.getJSON('<?= site_url('json/notification') ?>', function(r) {
                    var nbnotif = r.length;
                    $('#nbnotif').html(nbnotif);
                    if (nbnotif > 1) {
                        var m = "Vous avez " + nbnotif + " notifications";
                    } else if (nbnotif == 0) {
                        var m = "Aucune notification";
                    } else {
                        var m = "Vous avez " + nbnotif + " notification";
                    }
                    $('p[notif]').html(m);
                    var str = '';
                    $(r).each(function(i, e) {
                        str += `
                        <div class="notifi__item" item='${e.idnotification}'>
                            <div class="bg-c1 img-cir img-40 bg-danger">
                                <i class="zmdi zmdi-email-open"></i>
                            </div>
                            <div class="content">
                                <p>${e.contenu}</p>
                                <span class="date">${e.date}</span>
                            </div>
                        </div>
                    `;
                    });
                    $('div[notifzone]').html(str);
                    $('.notifi__item').off('click').click(function() {
                        var id = $(this).attr('item');
                        $.getJSON('<?= site_url('json/notification_del') ?>', {
                            item: id
                        });
                    })

                })
            }

            setInterval(() => {
                getNotif();
            }, 3000);

        <?php } ?>
    })
</script>